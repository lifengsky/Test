<?php

require __DIR__ . '/../core/base.php';


$req = Base::getRequestJson();

Base::checkAndDie([
	'arr' => Param::IS_ARRAY,
], $req);

function mySort($arr) {
	for($i=0;$i<count($arr);$i++){
		for($j=$i+1;$j<count($arr);$j++){
			if($arr[$i]>$arr[$j]){
				$stemp=$arr[$i];
				$arr[$i]=$arr[$j];
				$arr[$j]=$stemp;
			}
		}
	}
	return $arr;
}

$new_arr = mySort($req['arr']);

Base::dieWithResponse([
	'new_arr' => $new_arr,
]);
