<?php
$DiscoverIP="239.255.255.250";
$chosenRoom="Salon";
//$chosenRoom="Cuisine";
$i=0;

require("sonos.class.php");
//Instanciation de la classe
//Detection des SONOS presentes
$sonos = new SonosPHPController($DiscoverIP);
$instances = $sonos->detect();
//print_r($instances);
foreach ($instances as $instance)
{
	$instanceInfos = $instances[$i]->device_info();
	//print_r($instanceInfos);
	if ($instanceInfos['roomName']==$chosenRoom)
	{
		print "Etat de la SONOS \"". $instanceInfos['roomName']."\" : ";
		print $instances[$i]->GetTransportInfo() . "\n";
		if ($instances[$i]->GetTransportInfo()=="PLAYING"){
		print "Volume : ". $instances[$i]->GetVolume()."\n";}
		print "Piste : ". $instances[$i]->GetMediaInfo()."\n";
		print "Jouons un vinyle... \n";	
		$instances[$i]->SetQueue("x-rincon-mp3radio://192.168.1.60:8000/raspi");
		$instances[$i]->Play();
		$instances[$i]->SetVolume(40);
		print "Nouvelle Piste : ". $instances[$i]->GetMediaInfo()."\n";
	}
	$i++;
}
//$sonos_1 = new SonosPHPController($IP_sonos_1); 
//$volume = $sonos_1->GetVolume();
//if ($volume > 50)
//     $sonos_1 = $sonos_1->SetVolume(50);
?>
