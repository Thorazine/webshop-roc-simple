<?php

$students = [
	'Sinan', 'Mo', 'Murtaza',
	'Irfan', 'Sofyan', 'Ceyhun',
	'Alex', 'Ammaar', 'Burak',
	'Jaisy', 'Fedde', 'Mikal',
	'Noman', 'Mohamed', 'Taha',
	'Gavin', 'Bruna', 'Russell',
	'Bradley', 'Mitchel', 'Bruce',
	'Ymaro', 'Yasmine', 'Rona',
	'Issam'
];


echo $students[rand(1, count($students) - 1)]. '';
