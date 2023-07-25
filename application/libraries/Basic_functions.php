<?php

use libphonenumber\PhoneNumberUtil;
use Rogervila\ArrayDiffMultidimensional;
	class Basic_functions {

		protected $layout = 'layout/layout';
		public function render($file, $pageTitle, $sourcedData){
			$CI =& get_instance();
			$page_data = array();
			if(isset($sourcedData['page_data'])){
				$page_data = $sourcedData['page_data'];
			}
			$data['header'] = $CI->load->view('layout/header', array(
			),TRUE);
			$data['sidebar'] = $CI->load->view('layout/sidebar', array(),TRUE);
			$data['footer'] = $CI->load->view('layout/footer', array(),TRUE);
			$data['pageTitle'] = $pageTitle;
			$data['body'] = $CI->load->view($file,$page_data, TRUE);
			if(isset($sourcedData['page_data'])){
				$data['script_file'] = $sourcedData['script_file'];
			}
			$CI->load->view($this->layout, $data);
			return;		
		}
		public function createValidationRules($field, $label, $rules, $errors){
			return array(
				'field' => $field,
				'label' => $label,
				'rules' => $rules,
				'errors' => $errors,
			);
		}
		public function formValidationErrors($validationRules){
			$errors = array();
			foreach($validationRules as $rule){
				$errors[$rule['field']] = strip_tags(form_error($rule['field']));
			}
			return $errors;
		}
		public function validateForm($validationRules){
			$CI =& get_instance();
			$CI->load->database();
			$CI->form_validation->set_rules($validationRules);
			if ($CI->form_validation->run() == FALSE){
				$Message = json_encode(array(
					"status" => 0,
					"errors" => $this->formValidationErrors($validationRules)
				));
				echo $Message;
				exit;
			}
		}
		public function isJson($string) {
			if(substr($string, 0, 1) == "{" || substr($string, 0, 1) == "["){
				json_decode($string);
				return (json_last_error() == JSON_ERROR_NONE);
			} else {
				return false;
			}
		}
		public function isAssoc(array $arr){
			if (array() === $arr) return false;
			return array_keys($arr) !== range(0, count($arr) - 1);
		}
		function isMultiDimensionalArray($arr) {
			$rv = array_filter($arr, 'is_array');
			if(count($rv)>0) return true;			  
			return false;
		}
	}