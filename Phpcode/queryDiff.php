<?php

require __DIR__ . '/../core/base.php';


$req = Base::getRequestJson();//调用了base类下面的getRequestJson()方法

Base::checkAndDie([
	'arr1' => Param::IS_ARRAY,'arr2' => Param::IS_ARRAY,
], $req);

function queryDiff($arr1,$arr2) {
	$len1=count($arr1);
	$len2=count($arr2);
	//找出相同的元素
	$indexArr1=array();
	$indexArr2=array();
	for($i=0;$i<$len1;$i++){
		for($j=0;$j<$len2;$j++){
			if($arr1[$i]==$arr2[$j]){
				array_push($indexArr1,$i);
				array_push($indexArr2,$j);
				break;
			}
		}
	}
//找出第一个数组中的不同元素
	$diffArr=array();
	$isExist=false;
	for($i=0;$i<$len1;$i++){
		for($j=0;$j<count($indexArr1);$j++){
			if($i==$indexArr1[$j]){
				$isExist=true;
			}
		}
		if(!$isExist){
			array_push($diffArr,$arr1[$i]);
		}
		$isExist=false;
	}
	//找出第二个数组中的不同元素

	for($i=0;$i<$len2;$i++){
		for($j=0;$j<count($indexArr2);$j++){
			if($i==$indexArr2[$j]){
				$isExist=true;
			}
		}
		if(!$isExist){
			array_push($diffArr,$arr2[$i]);
		}
		$isExist=false;
	}
	return $diffArr;
}

$new_arr =queryDiff($req['arr1'],$req['arr2']);


Base::dieWithResponse([
	'new_arr' => $new_arr,
]);
