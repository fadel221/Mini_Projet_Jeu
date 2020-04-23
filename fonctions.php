<?php 
function five_best_score ($tab_score)
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

function taille_tab_json ($tab)
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
 ?>
