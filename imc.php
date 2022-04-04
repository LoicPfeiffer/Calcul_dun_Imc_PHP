<h2>Calcul IMC</h2>
    
    <?php 
        $action = filter_var($_SERVER['PHP_SELF'], FILTER_VALIDATE_URL);
        $nom = 'poids';
        $nom2 = 'taille';
        $taille = -1; $poids = -1;
        if(isset($_GET[$nom]) && isset($_GET[$nom2])) {
            $saisie = $_GET[$nom];
            $poids = intval($saisie);

            $saisie = $_GET[$nom2];
            $taille = intval($saisie);
        }
        ?>
        <form method="GET" action="<?= $action ?>">
            <label for name="<?= $nom ?>">Poids (kg)</label>
            <input type="number" name="<?= $nom ?>" min="0" step="1" /><br>
            <label for name="<?= $nom2 ?>">Taille (cm)</label>
            <input type="number" name="<?= $nom2 ?>" min="80" step="1" max="300" /><br>
            <input type="submit" value="envoyer">
        </form>

        <?php

            function imc(int $poids, float $taille) {
                if($taille > 0 && $poids > 0) {
                    $imc = $poids / $taille ** 2;
                    if($imc < 6 or $imc > 70) {
                        return -1;
                    }
                    return $imc;
                }
                else 
                    return -1;
            }

            function corpulence(float $imc) {
                if($imc <= 6)
                    return 'erreur (<6)';
                if($imc <= 18)
                    return 'maigre';
                if($imc <= 25)
                    return 'normale';
                if($imc <= 30)
                    return 'obèse';
                if($imc <= 70)
                    return 'obésité morbide';
                return 'erreur (>70)';
            }

            function corpulence2(float $imc) {
                $retour = '';

                if($imc <= 6)
                    $retour = 'erreur (<6)';
                elseif($imc <= 18)
                    $retour = 'maigre';
                elseif($imc <= 25)
                    $retour = 'normale';
                elseif($imc <= 30)
                    $retour = 'obèse';
                elseif($imc <= 70)
                    $retour = 'obésité morbide';
                else 
                    $retour = 'erreur (>70)';

                return $retour;
            }

            if($taille > 0 && $poids > 0) {
                $vImc = imc($poids, $taille / 100);
                $info = corpulence($vImc);
                $info2 = corpulence2($vImc);

                if($vImc > 0) {
                    echo 'taille : ' . $taille . ' poids : ' . $poids .
                        ' imc=' . number_format($vImc,1,',') . ' corpulence ' . $info2;
                }
                else {
                    echo 'taille : ' . $taille . ' poids : ' . $poids . ' erreur calcul IMC<br>';
                }

            }
        
        ?>