<?php

	class Sanitize{

		public function sanitizeText($text){

			$text = strip_tags($text);
			$text = filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$text = addslashes($text);

			return $text;
		}

		public function sanitizeNumber($num){

			$num = filter_var($num, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


			$num = addslashes($num);

			return $num;
		}

		public function sanitizeId($id){

			$id = strip_tags($id);
			$id = filter_var($id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

			$id = addslashes($id);

			return $id;
		}


	}
?>