<?php
	class webtor {

		// Rapid API Key which is given upon subscription to rapidapi.com
		const RapidAPIKey = "";

		// Returns resource id from a magnet link
		public function GetResourceID($magnet) {
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => "https://webtor.p.rapidapi.com/resource",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $magnet,
				CURLOPT_HTTPHEADER => [
					"X-RapidAPI-Host: webtor.p.rapidapi.com",
					"X-RapidAPI-Key: " . self::RapidAPIKey . "",
					"content-type: text/plain"
				],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if ($err) {
				return false;
			} else {
				$data = json_decode($response); 
				return $data->id;
			}
		}

		// Returns resource name from a magnet link
		public function GetResourceName($magnet) {
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => "https://webtor.p.rapidapi.com/resource",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $magnet,
				CURLOPT_HTTPHEADER => [
					"X-RapidAPI-Host: webtor.p.rapidapi.com",
					"X-RapidAPI-Key: " . self::RapidAPIKey . "",
					"content-type: text/plain"
				],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if ($err) {
				return false;
			} else {
				$data = json_decode($response); 
				return $data->name;
			}
		}

		// Returns array of contents from resource id
		public function ListResourceContents($resourceid) {
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => "https://webtor.p.rapidapi.com/resource/".$resourceid."/list",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => [
					"X-RapidAPI-Host: webtor.p.rapidapi.com",
					"X-RapidAPI-Key: " . self::RapidAPIKey . "",
				],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				return false;
			} else {
				$data = json_decode($response);
				return isset($data->items) ? $data->items : [];
			}
		}

		// Returns direct download link of the specifed content id from resource id
		public function ExportResourceContent($resourceid, $contentid) {
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => "https://webtor.p.rapidapi.com/resource/".$resourceid."/export/".$contentid."",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => [
					"X-RapidAPI-Host: webtor.p.rapidapi.com",
					"X-RapidAPI-Key: " . self::RapidAPIKey . "",
				],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				return false;
			} else {
				$data = json_decode($response);
				return $data->exports->download->url;
			}
		}

		// Returns name of the specifed content id from resource id
		public function GetContentName($resourceid, $contentid) {
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => "https://webtor.p.rapidapi.com/resource/".$resourceid."/export/".$contentid."",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => [
					"X-RapidAPI-Host: webtor.p.rapidapi.com",
					"X-RapidAPI-Key: " . self::RapidAPIKey . "",
				],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				return false;
			} else {
				$data = json_decode($response);
				return $data->source->name;
			}
		}

		// Checks whether torrent contains video content
		public function IsPlayable($magnet) {
			$resourceid = $this->GetResourceID($magnet);
			$contents = $this->ListResourceContents($resourceid);

			foreach ($contents as $content) {
				if(isset($content->media_format)) {
					if($content->media_format == "video") {
						return true;
					}
				}
			}
			return false;
		}

		// Returns direct download link and subtitle name as array to the first subtitle found, or false if there are none.
		// Usage example: list($downloadlink, $subtitlename) = $webtor->FindSubtitle();
		public function FindSubtitles($magnet) { 
			$resourceid = $this->GetResourceID($magnet);
			$contents = $this->ListResourceContents($resourceid);

			foreach ($contents as $content) {
				if(isset($content->media_format)) {
					if($content->media_format == "subtitle") {
						return array($this->ExportResourceContent($resourceid, $content->id), $this->GetContentName($resourceid, $content->id));
					}
				}
			}
			return false;
		}
	}
