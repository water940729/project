<?php
    namespace Home\Controller;
    use Think\Controller;
    class EmptyController extends Controller{
		 public function _empty($name){
		//�����г��еĲ���������city����
			$this->redirect("index/index");
		}
    }