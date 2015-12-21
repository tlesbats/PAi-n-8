<?php

function ajouteScript($chpHeure, $chpMinute, $chpJourMois, $chpJourSemaine, $chpMois, $chpCommande, $chpCommentaire)
{

        $debut = '#Les lignes suivantes sont gerees automatiquement via un script PHP. - Merci de ne pas editer manuellement';
        $fin = '#Les lignes suivantes ne sont plus gerees automatiquement';

        $oldCrontab = Array();                          /* pour chaque cellule une ligne du crontab actuel */
        $newCrontab = Array();                          /* pour chaque cellule une ligne du nouveau crontab */

        $isSection = false;
        $maxNb = 0;                                     /* le plus grand numéro de script trouvé */

        exec('crontab -l', $oldCrontab);                /* on récupère l'ancienne crontab dans $oldCrontab */
        foreach($oldCrontab as $index => $ligne)        /* copie $oldCrontab dans $newCrontab et ajoute le nouveau script */
        {
                if ($isSection == true)                 /* on est dans la section gérée automatiquement */
                {
                        $motsLigne = explode(' ', $ligne);

                        if ($motsLigne[0] == '#' && $motsLigne[1] > $maxNb)     /* si on trouve un numéro plus grand */
                                $maxNb = $motsLigne[1];
                }

                if ($ligne == $debut) { $isSection = true; }

                if ($ligne == $fin)                     /* on est arrivé à la fin, on rajoute le nouveau script */
                {
                        $id = $maxNb + 1;
                        $newCrontab[] = '# '.$id.' : '.$chpCommentaire;
                        $newCrontab[] = $chpMinute.' '.$chpHeure.' '.$chpJourMois.' '.
                                $chpMois.' '.$chpJourSemaine.' '.$chpCommande;
                }

                $newCrontab[] = $ligne;                 /* copie $oldCrontab, ligne après ligne */
        }

        if ($isSection == false)                        /* s'il n'y a pas de section gérée par le script */
        {                                               /*  on l'ajoute maintenant */
                $id = 1;
                $newCrontab[] = $debut;
                $newCrontab[] = '# 1 : '.$chpCommentaire;

                $newCrontab[] = $chpMinute.' '.$chpHeure.' '.$chpJourMois.' '.$chpMois.' '.$chpJourSemaine.' '.$chpCommande;
                $newCrontab[] = $fin;
        }

        $f = fopen('./tmp', 'w');                        /* on crée le fichier temporaire */
        fwrite($f, implode('\n', $newCrontab));
        fclose($f);
        exec('crontab ./tmp');                           /* on le soumet comme crontab */

        return  $id;
}

function retireScript($id)
{
        $debut = '#Les lignes suivantes sont gerees automatiquement via un script PHP. - Merci de ne pas editer manuellement';
        $fin = '#Les lignes suivantes ne sont plus gerees automatiquement';

        $oldCrontab = Array();                          /* pour chaque cellule une ligne du crontab actuel */
        $newCrontab = Array();                          /* pour chaque cellule une ligne du nouveau crontab */

        $isSection = false;
        $isScript = false;

        exec('crontab -l', $oldCrontab);                /* on récupère l'ancienne crontab dans $oldCrontab */

        foreach($oldCrontab as $ligne)                  /* copie $oldCrontab dans $newCrontab sans le script à effacer */
        {
                if ($isScript){
                        $isScript = false;
                }
                else if ($isSection == true)                 /* on est dans la section gérée automatiquement */
                {
                        $motsLigne = explode(' ', $ligne);

                        if ($motsLigne[0] != '#' || $motsLigne[1] != $id)       /* ce n est pas le script à effacer */
                        {
                                $newCrontab[] = $ligne;                 /* copie $oldCrontab, ligne après ligne */
                        }else{
                                $isScript = true;
                        }
                }else{
                        $newCrontab[] = $ligne;         /* copie $oldCrontab, ligne après ligne */
                }
                if ($ligne == $debut) {$isSection = true;}
        }

        $f = fopen('./tmpCronTab', 'w');                 /* on crée le fichier temporaire */
        fwrite($f, implode("\n", $newCrontab));
        fclose($f);
        exec('crontab ./tmpCronTab');                    /* on le soumet comme crontab */

        return  $id;
}
