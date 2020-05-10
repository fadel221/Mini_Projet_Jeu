<?php

function five_best_score($tab_score)
{
	for ($i=1;$i<=5;$i++)
	{
		$max=$tab_score[0];

		for ($j=1;$j<count($tab_score);$j++)
		{
			if (isset($tab_score[$j]))
			{
			if (!($tab_score[$j]<=$max))
			{
				$max=$tab_score[$j];
				$indice=$j;
			}
		}
		}
		$tab[]=$max;
		unset($tab_score[$indice]);
	}
	
	return ($tab);
}

function taille_tab_json($tab)
{
$i=0;
	foreach ($tab as $key => $value) {
			foreach ($value as $key2 => $value2) {
				if ($key2=="score")
					$i++;
			}
	}

		return $i;
	}

	function reccupere_joueur($tab)
	{
		for ($i=0;$i<=count($tab);$i++)
		{
			if (isset($tab[$i]["score"]))
			{
				
				$tab_joueur[]=$tab[$i];
			}
		}
	
	return ($tab_joueur);

	}

	function trouve_best_players($json,$tab)
	{
		for ($j=0;$j<5;$j++)
			{
				for ($i=0;$i<count($json);$i++)
				{
					if (isset($json[$i]["score"]))
					{
					if ($json[$i]["score"]==$tab[$j])
					{
						$tab_best_player[]=$json[$i]["username"]." ".$json[$i]["nom"];
					}
				}
			}
			}
			return ($tab_best_player);
	}

	function reccupere_reponse_simple($json)
		{
				foreach ($json as $key => $element) {
					
					if (!($key=="nb-point" || $key=="question" || $key=="radio" || $key=="type-reponse"))
												$tab_reponses[]=$element;
				}

				return $tab_reponses;
			}
		
function reccupere_cle_reponse_simple($json)
		{
				foreach ($json as $key => $element) {
					
					if (!($key=="nb-point" || $key=="question" || $key=="radio" || $key=="type-reponse" || $key=="index"))
												$tab_cle_reponses[]=$key;
				}

				return $tab_cle_reponses;
			}



function trie_decroissant_score($tab)
{
	for ($i=0;count($tab)>$i;$i++)
	{
		for ($j=$i+1;count($tab)>$j;$j++)
		{

			if ($tab[$j]["score"]>$tab[$i]["score"])
			{
				$temp=$tab[$j]["score"];
				$tab[$j]["score"]=$tab[$i]["score"];
				$tab[$i]["score"]=$temp;
			}
		
		}
	}
	return ($tab);
}

function nb_reponse_checkbox ($nb_chechbox,$indice)
{
		for ($i=0;$nb_chechbox>$i;$i++)
		{
			$j=$i+1;
			$chaine="reponse_multiple_".$j;
				if (isset($_POST[$chaine]))
				{
					$_SESSION["reponse_multiple"][$indice][]=$_POST[$chaine];
				}
		}
}

	
 
function reccupere_indice_question($json,$index)
			
			{
							for ($i=0;count($json)>$i;$i++)
							{
									if ($json[$i]["index"]==$index)
									{
										break;
									}
							}
							return ($i);
			}
			
function reccupere_reponse_multiple ($json_question,$indice)
{
	
                    for ($j=0;$j<count($json_question[$indice]);$j++)
                    {
                        
	                     if (isset($json_question[$indice]["check_".($j+1)]))
	                     {
	                        $tab_reponse[]=$json_question[$indice]["check_".($j+1)];
	                     }

               					}

               						return ($tab_reponse);
}

			




 ?>
