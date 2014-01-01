<?php 
class article
{
	private $titre;
	private $texte;
	private $textePlus;
	private $dateDebut;
	private $dateFin;
	private $lieu;
	private $mktime;
	private $indice;
	private $isIndex;
	
  
	public function __construct($dateDebut, $dateFin, $titre, $texte, $textePlus, $lieu, $indice)
	{
	    $this->titre = utf8_decode($titre);
	    $this->texte = utf8_decode($texte);
	    $this->textePlus = utf8_decode($textePlus);
	    $this->dateDebut = $dateDebut;
	    $this->dateFin = $dateFin;
	    $this->lieu = utf8_decode($lieu);
	    $this->indice = $indice;
	    $this->mktime = false;
	    $this->isIndex = false;
	    
	}
	
	private function dateTitre()
	{// formatage du titre par defaut en fonction des dates de l'évenement
	    
	    if(empty($this->dateDebut)) return '';
	    if((empty($this->dateFin)) || ("--" == $this->dateFin)) {$this->dateFin = $this->dateDebut;}
	    $aJour = array("", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
	    $aMois = array("", "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");
	    list ($an, $mois, $jour) = explode("-",$this->dateDebut );
	    $this->mktime = $mktime = mktime(0,0,0, $mois, $jour, $an);
	    if($this->dateDebut  == $this->dateFin )
	    {
	        return $aJour[date("N",$mktime)]." ".$jour." ".$aMois[(int)$mois]." ".$an;
	    }
	    else
	    {
	        list ($anFin, $moisFin, $jourFin) = explode("-",$this->dateFin);
	        $mktimeFin = mktime(0,0,0, $moisFin, $jourFin, $anFin);
	        $return = "du ".$aJour[date("N",$mktime)]." ".$jour." ".$aMois[(int)$mois]." ".$an.
	                  " au ".$aJour[date("N",$mktimeFin)]." $jourFin ".$aMois[(int)$moisFin]." ".$anFin;
	         return $return;
	    }
	   
	}
	
	public function loadArticle()
	{// construction de l'article
	    if(empty($this->titre))
	    {// le titre est vide on le construit avec les dates ...
	        $this->titre = $this->dateTitre();
	    }
	    else
	    {
	        $this->titre = $this->titre;
	    }
	    
	    if((!empty($this->lieu)) && (!empty($this->titre)))
	    {
	        $this->titre .= " (".$this->lieu.")";
	    }
	    
	}
	
	private function remplaceSportParLiensVersSport($leTexte) {
	
			$lienZumba ="gymnastique/zumba.php"; 
			$lienGR = "gymnastique/gymnastique-rythmique.php";
			$lienHD = "gymnastique/house-dance.php";
			$lienGym = "gymnastique/gymnastique.php";
			$lienHH = "gymnastique/hip-hop.php";
			$lienLIA = "gymnastique/lia.php";
			
			$leTexte = str_replace("zumba", '<span  class="liensDiscipline"><a href="'.$lienZumba.'" style="text-decoration:none">zumba</a></span>', $leTexte);
			$leTexte = str_replace("Zumba", '<span  class="liensDiscipline"><a href="'.$lienZumba.'" style="text-decoration:none">Zumba</a></span>', $leTexte);
			$leTexte = str_replace("ZUMBA", '<span  class="liensDiscipline"><a href="'.$lienZumba.'" style="text-decoration:none">ZUMBA</a></span>', $leTexte);
			
			
			$leTexte = str_replace("gymnastique-rythmique", '<span  class="liensDiscipline"><a href="'.$lienGR.'" style="text-decoration:none">gymnastique-rythmique</a></span>', $leTexte);
			$leTexte = str_replace("Gymnastique-Rythmique", '<span  class="liensDiscipline"><a href="'.$lienGR.'" style="text-decoration:none">Gymnastique-Rythmique</a></span>', $leTexte);
			$leTexte = str_replace("Gymnastique-rythmique", '<span  class="liensDiscipline"><a href="'.$lienGR.'" style="text-decoration:none">Gymnastique-rythmique</a></span>', $leTexte);
			
			$leTexte = str_replace(" gr ", ' <span  class="liensDiscipline"><a href="'.$lienGR.'" style="text-decoration:none">gr</a> ', $leTexte);
			$leTexte = str_replace(" GR ", ' <span  class="liensDiscipline"><a href="'.$lienGR.'" style="text-decoration:none">GR</a> ', $leTexte);
			
			$leTexte = str_replace("GYMNASTIQUE-RYTHMIQUE", '<span  class="liensDiscipline"><a href="'.$lienGR.'" style="text-decoration:none">GYMNASTIQUE-RYTHMIQUE</a></span>', $leTexte);
			
			
			
			$leTexte = str_replace("gymnastique ", '<span  class="liensDiscipline"><a href="'.$lienGym.'" style="text-decoration:none">gymnastique</a> ', $leTexte);
			$leTexte = str_replace("Gymnastique ", '<span  class="liensDiscipline"><a href="'.$lienGym.'" style="text-decoration:none">Gymnastique</a> ', $leTexte);
			$leTexte = str_replace("GYMNASTIQUE ", '<span  class="liensDiscipline"><a href="'.$lienGym.'" style="text-decoration:none">GYMNASTIQUE</a> ', $leTexte);
			$leTexte = str_replace("gymnastique.", '<span  class="liensDiscipline"><a href="'.$lienGym.'" style="text-decoration:none">gymnastique</a>.', $leTexte);
			$leTexte = str_replace("Gymnastique.", '<span  class="liensDiscipline"><a href="'.$lienGym.'" style="text-decoration:none">Gymnastique</a>.', $leTexte);
			$leTexte = str_replace("GYMNASTIQUE.", '<span  class="liensDiscipline"><a href="'.$lienGym.'" style="text-decoration:none">GYMNASTIQUE</a>.', $leTexte);
			
			$leTexte = str_replace("house-dance", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">house-dance</a></span>', $leTexte);
			$leTexte = str_replace("House Dance", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">House Dance</a></span>', $leTexte);
			$leTexte = str_replace("House Dance", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">House Dance</a></span>', $leTexte);
			$leTexte = str_replace("house dance", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">house dance</a></span>', $leTexte);
			$leTexte = str_replace("HOUSE DANCE", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">HOUSE DANCE</a></span>', $leTexte);
			$leTexte = str_replace("House-Dance", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">House-Dance</a></span>', $leTexte);
			$leTexte = str_replace("House-Dance", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">House-Dance</a></span>', $leTexte);
			$leTexte = str_replace("HOUSE-DANCE", '<span  class="liensDiscipline"><a href="'.$lienHD.'" style="text-decoration:none">HOUSE-DANCE</a></span>', $leTexte);
			
			$leTexte = str_replace("hip-hop", '<span  class="liensDiscipline"><a href="'.$lienHH.'" style="text-decoration:none">hip-hop</a></span>', $leTexte);
			$leTexte = str_replace("Hip-Hop", '<span  class="liensDiscipline"><a href="'.$lienHH.'" style="text-decoration:none">Hip-Hop</a></span>', $leTexte);
			$leTexte = str_replace("hip hop", '<span  class="liensDiscipline"><a href="'.$lienHH.'" style="text-decoration:none">hip hop</a></span>', $leTexte);
			$leTexte = str_replace("Hip Hop", '<span  class="liensDiscipline"><a href="'.$lienHH.'" style="text-decoration:none">Hip Hop</a></span>', $leTexte);
			$leTexte = str_replace("HIP HOP", '<span  class="liensDiscipline"><a href="'.$lienHH.'" style="text-decoration:none">HIP HOP</a></span>', $leTexte);
			$leTexte = str_replace("HIP-HOP", '<span  class="liensDiscipline"><a href="'.$lienHH.'" style="text-decoration:none">HIP-HOP</a></span>', $leTexte);
			
			$leTexte = str_replace(" lia ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">lia</a></span>', $leTexte);
			$leTexte = str_replace(" Lia ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">Lia</a></span>', $leTexte);
			$leTexte = str_replace(" LIA ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">LIA</a></span>', $leTexte);
			$leTexte = str_replace(" lia, ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">lia</a>,</span>', $leTexte);
			$leTexte = str_replace(" Lia, ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">Lia</a>,</span>', $leTexte);
			$leTexte = str_replace(" LIA, ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">LIA</a>,</span>', $leTexte);
			$leTexte = str_replace(" lia. ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">lia</a>.</span>', $leTexte);
			$leTexte = str_replace(" Lia. ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">Lia</a>.</span>', $leTexte);
			$leTexte = str_replace(" LIA. ", '<span  class="liensDiscipline"><a href="'.$lienLIA.'" style="text-decoration:none">LIA</a>.</span>', $leTexte);
			
			return $leTexte;
	}
	
	public function articleComplet($isIndex = false, $htmlentities = false)
	{
	    $this->isIndex = $isIndex;
	    $strongDeb = "<strong>";
	    $strongFin = "</strong>";
	    $leTitre = ucfirst($this->titre);
	    $leTexte = $this->texte;
	    $leTextePlus = $this->textePlus;
	    if($htmlentities)
	    {
    	    $leTitre = str_replace("<", "BALISE#OUVRANTE", $leTitre);
    	    $leTitre = str_replace(">", "BALISE#FERMANTE", $leTitre);
    	    $leTitre = htmlentities($leTitre);
    	    $leTitre = str_replace("BALISE#OUVRANTE", "<", $leTitre);
    	    $leTitre = str_replace("BALISE#FERMANTE", ">", $leTitre);
    	    $leTitre = str_replace("&amp;", "&", $leTitre);
    	    
    	    $leTexte = str_replace("<", "BALISE#OUVRANTE", $this->texte);
    	    $leTexte = str_replace(">", "BALISE#FERMANTE", $leTexte);
    	    $leTexte = htmlentities($leTexte);
    	    $leTexte = str_replace("BALISE#OUVRANTE", "<", $leTexte);
    	    $leTexte = str_replace("BALISE#FERMANTE", ">", $leTexte);
    	    $leTexte = str_replace("&amp;", "&", $leTexte);
    	    $leTexte = str_replace("\n", "<br/>", $leTexte);
    	    
    	    $leTextePlus = str_replace("<", "BALISE#OUVRANTE", $this->textePlus);
    	    $leTextePlus = str_replace(">", "BALISE#FERMANTE", $leTextePlus);
    	    $leTextePlus = htmlentities($leTextePlus);
    	    $leTextePlus = str_replace("BALISE#OUVRANTE", "<", $leTextePlus);
    	    $leTextePlus = str_replace("BALISE#FERMANTE", ">", $leTextePlus);
    	    $leTextePlus = str_replace("&amp;", "&", $leTextePlus);
    	    $leTextePlus = str_replace("\n", "<br/>", $leTextePlus);
	    }
	    else
	    {
	          $leTexte = str_replace("\n", "<br/>", $leTexte);
	          $leTextePlus = str_replace("\n", "<br/>", $leTextePlus);        
	    }
		$leTexte = $this->remplaceSportParLiensVersSport($leTexte);
		$leTextePlus = $this->remplaceSportParLiensVersSport($leTextePlus);
		
	    if(!$this->mktime)
	    {
	        list ($an, $mois, $jour) = explode("-",$this->dateDebut );
	        $this->mktime = $mktime = mktime(0,0,0, $mois, $jour, $an);
	    }
	    
	    if($this->mktime < time())
	    {
	         $strongDeb = "";
	         $strongFin = "";
	    }
	    //on affiche en plus gros les deux premiers articles si on est sur l'index 
	    if($isIndex)
	    {
	        $article = '
	        <tr>
        	<td>
            	<strong>';
	        if(strpos($_SERVER["REQUEST_URI"], 'voir') !== false)
	        {
	            $article.=' <a href="'.$_GET["p"].'">';
	        }
	        else
	        {
	            $article.=' <a href="/voir.php?x='.$this->indice.'&p='.$_SERVER["REQUEST_URI"].'">';
	        }
            $article.=  $leTitre . ' </strong></a>
				'. $leTexte ;
            if(!empty($this->textePlus)) {$article.='<br/>' . $leTextePlus . '';}
			$article.='
            </td>
        </tr>
	        ';
	    }
	    else
	    {
    	    $article=
    	    '
    	    <li id="liTitre">';
    	        if(strpos($_SERVER["REQUEST_URI"], 'voir') !== false)
    	        {
    	            $article.='<h3 style="color: black;" id="H3titre"> <a href="'.$_GET["p"].'">';
    	        }
    	        else
    	        {
    	            $article.='<h3 style="color: black;" id="H3titre"> <a href="/voir.php?x='.$this->indice.'&p='.$_SERVER["REQUEST_URI"].'">';
    	        }
                $article.= ' ' . $leTitre . '</a> </h3>
                <p id="pTexte">' . $strongDeb . $leTexte . $strongFin . '</p>';
    	        if(!empty($this->textePlus)) {$article.='<p>' . $strongDeb . $leTextePlus . $strongFin . '</p>';}
    	        $article.= '<div id="pTexte"></div>';
    	    $article.='
             </li>
            ';
	    }
	    return $article;
	} 
	/**
     * @return the $titre
     */
    public function getTitre ()
    {
        return $this->titre;
    }

	/**
     * @return the $texte
     */
    public function getTexte ()
    {
        return $this->texte;
    }

	/**
     * @return the $dateDebut
     */
    public function getDateDebut ()
    {
        return $this->dateDebut;
    }

	/**
     * @return the $dateFin
     */
    public function getDateFin ()
    {
        return $this->dateFin;
    }

	/**
     * @param $titre the $titre to set
     */
    public function setTitre ($titre)
    {
        $this->titre = $titre;
    }

	/**
     * @param $texte the $texte to set
     */
    public function setTexte ($texte)
    {
        $this->texte = $texte;
    }

	/**
     * @param $dateDebut the $dateDebut to set
     */
    public function setDateDebut ($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

	/**
     * @param $dateFin the $dateFin to set
     */
    public function setDateFin ($dateFin)
    {
        $this->dateFin = $dateFin;
    }

  /**
     * @return the $indice
     */
    public function getIndice ()
    {
        return $this->indice;
    }

	/**
     * @param $indice the $indice to set
     */
    public function setIndice ($indice)
    {
        $this->indice = $indice;
    }
	/**
     * @return the $textePlus
     */
    public function getTextePlus ()
    {
        return $this->textePlus;
    }

	/**
     * @param $textePlus the $textePlus to set
     */
    public function setTextePlus ($textePlus)
    {
        $this->textePlus = $textePlus;
    }
	/**
     * @return the $lieu
     */
    public function getLieu ()
    {
        return $this->lieu;
    }

	/**
     * @return the $mktime
     */
    public function getMktime ()
    {
        return $this->mktime;
    }

	/**
     * @param $lieu the $lieu to set
     */
    public function setLieu ($lieu)
    {
        $this->lieu = $lieu;
    }


    
}

?>