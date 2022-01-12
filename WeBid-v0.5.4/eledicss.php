<?php
/*
    This file is part of Eledicss.

    Eledicss is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    Eledicss is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Eledicss; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

    Copyright oct. 2004
        Florent Jugla <florent.jugla@eledo.com>,

*/


define("ROOT", "root");
define("ERROR", "error");
define("COMMENT", "comment");
define("DECLARATION", "declaration");
define("RULESET", "ruleset");
define("STYLESHEET", "stylesheet");
define("CHARSET_SYM", "charset_sym");
define("IMPORT", "import");
define("NAMESPACE", "namespace");
define("MEDIA", "media");
define("PAGE", "page");
define("FONTFACE", "font-face");


$node_id = 0;
$li = true;  // large interpretation css2 + @namespace + _ at nmstart

class node {
  
  var $type;
  var $id;
  var $pid;
  var $pt;   // pointer dans la string
  var $end;  // end de string
  var $tok;  // token
  var $dsp;  // vrai quand le noeud a ete affiche
  var $sons;  // les fils du noeud
  
  function node(&$p, $type, $pt, $tok="") {
    global $node_id;


    $this->type = $type;
    $this->id = $node_id;
    $node_id++;

    $this->pt = $pt;
    $this->tok = $tok;
    $this->dsp = false;

    if (is_object($p))
      {
	$this->pid = $p->id;
	$p->set_son($this->id);
      }
    else
      $this->pid = -1;

    $this->sons = array();
  }

  function set_son($id)
    {
      $this->sons[] = $id;
    }

  function get_html(&$str)
    {
      if ($str != "")
	{
	  $tok = str_replace(" ", "&nbsp;", $str);
	  $tok = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $tok);
	}
      else
	{
	  $tok = str_replace(" ", "&nbsp;", $this->tok);
	  $tok = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $tok);
	}

      if ($this->type == ERROR)
	return "<span id='cr' onDblClick='rw(".$this->id.");'>".$tok."</span>";
      else if ($this->type == COMMENT)
	return "<span id='cg' onDblClick='rw(".$this->id.");'>".$tok."</span>";
      else
	return "<span id='cn' onDblClick='rw(".$this->id.");'>".$tok."</span>";
    }

  function is_CR($c) 
    {
      if ($c=="\n" || $c=="\f")
	return true;
      return false;
    }

  function calc_dim($nbrows, $nbcols, &$tok)
    {
      $nbrows = $nbcols = $cols = 0;
      $lg = strlen($tok);
      $pt = 0;
      while($pt < $lg)
	{
	  $c = $tok[$pt];

	  if ($this->is_CR($c))
	    {
	      $nbrows ++;
	      if ($cols > $nbcols)
		$nbcols = $cols;
	      $cols = 0;
	    }
	  else
	    $cols ++;

	  $pt ++;
	}

      if ($cols > $nbcols)
	$nbcols = $cols;
      if ($nbrows == 0)
	$nbcols = $cols;
      $nbcols += 5;
      $nbrows ++;
    }

  function get_html_editable($str)
    {
      if ($str != "")
	$tok = $str;
      else
	$tok = $this->tok.$this->end;

      if ( ($this->type == ERROR) ||
	   ($this->type == RULESET) ||
	   ($this->type == ROOT) ||
	   ($this->type == IMPORT) ||
	   ($this->type == NAMESPACE) ||
	   ($this->type == DECLARATION) ||
	  ($this->type == COMMENT) )
	{
	  $nbrows = $nbcols = 0;
	  $this->calc_dim(&$nbrows, &$nbcols, $tok);

	  $sp = "<span><textarea rows=\"".$nbrows."\" cols=\"".$nbcols."\"".
	    " name=\"nval\">".$tok."</textarea></span>";

	  $ok = "<input ALT=\"ok\" title=\"ok\" type=\"image\" value=\"ok\" HSPACE=0 ".
	    "border=0 src=\"./eledicss.php?image=ok\" name=\"ok\" onClick=\"submit();\">";

	  $cancel = "<input ALT=\"cancel\" title=\"cancel\" type=\"image\" value=\"cancel\" HSPACE=0 ".
	    "border=0 src=\"./eledicss.php?image=cancel\" name=\"cancel\" onClick=\"submit();\">";

	  $w = $nbcols*7;
	  $h = $nbrows*12+140;
	  if ($w<300) $w=300;
	  /*
	  $view = "<input ALT=\"view\" title=\"view\" type=\"image\" value=\"view\" HSPACE=0 ".
	    "border=0 src=\"./eledicss.php?image=view\" name=\"view\" onClick=\"".
	    "window.open('./eledicss.php?view=true&nbrows=".$nbrows."&type=".$this->type."&val=".cssurlencode($tok).
	    "','_blank','toolbar=0,location=0,directories=0,status=0'+getCoord(event)+',".
	    "scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=".$w.
	    ",height=".$h."');return false;\">";
	  */
	  $view = "<input ALT=\"view\" title=\"view\" type=\"image\" value=\"view\" HSPACE=0 ".
	    "border=0 src=\"./eledicss.php?image=view\" name=\"view\" onClick=\"".
	    "window.open('./eledicss.php?view=true&nbrows=".$nbrows."&type=".$this->type.
	    "&val='+encode64(document.formulaire.nval.value)+'".
	    "','_blank','toolbar=0,location=0,directories=0,status=0'+getCoord(event)+',".
	    "scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=".$w.
	    ",height=".$h."');return false;\">";
	  
	  $bts = $ok;
	  if (($this->type == DECLARATION)||($this->type==RULESET))
	    $bts .= $view;
	  $bts .= $cancel;

	  return $sp.
	    "<input type=\"hidden\" value=\"".$this->pt."\" name=\"ptnid\">\n".
	    "<input type=\"hidden\" value=\"".strlen($tok)."\" name=\"oldlen\">\n".
	    $bts."</span>";
	}

      $astr = "";
      return $this->get_html($astr);
    }

  function in_node(&$pt)
    {
      if (($pt >= $this->pt) && ($pt < $this->pt+strlen($this->tok)))
	return true;
      return false;
    }

  function inc_node($nd)
    {
      if (($nd->pt >= $this->pt) && (($nd->pt+strlen($nd->tok)) < $this->pt+strlen($this->tok)))
	return true;
      return false;
    }

};

// fonction statique pour trier les noeuds
// par ordre pt
function node_sort_pt(&$a, &$b)
{
   if ($a->pt == $b->pt)
     return ($a->id <= $b->id) ? -1 : 1;
   return ($a->pt < $b->pt) ? -1 : 1;
}

// static function to sort nodes by
// id
function node_sort_id(&$a, &$b)
{
   return ($a->id < $b->id) ? -1 : 1;
}



class css {
  
  var $nodea;  // node array
  var $nodeid;  // node array by id
  var $nodepos; // node id by position (just for comments)

  var $pt;  // pointer  string
  var $str;  // string
  var $lg;  // longueur de la string
  var $nid;  // node id
  var $tok;  // current token
  var $end;  // vrai quand fin de fichier atteinte
  var $stop;  // vrai quand un fonction non node doit arreter
  var $rp;  // path du fichier css
  
  function css($rp) 
    {

      $this->rp = $rp;
      $this->nodea = array();

      $css = "";
      $fd = fopen($this->rp, "r");
      if ($fd)
	{
	  while ($ln = fgets($fd, 1024))
	    $css .= $ln;
	  fclose($fd);
	}
      else
	{
	  $page = "fichier : ".$file." illisible.\n";
	  exit(2);
	}
      
      $this->pt = 0;
      $this->str = $css;
      $this->lg = strlen($css);
      $this->nid = 0;
      $this->end = false;
      $this->stop = false;

      for($i=0; $i<$this->lg; $i++)
	$this->nodepos[$i] = -1;
    }

  function erase_comments(&$ndr)
    {
      $pt = 0;
      $str = "";
      
      while($pt < $this->lg)
	{
	  $c = $this->str[$pt].$this->str[$pt+1];

	  if ($c == "/*")
	    {
	      $svpt = $pt;
	      $strn = "";

	      while(($c != "*/") && ($pt < $this->lg))
		{
		  if (!$this->is_CR($c[0]))
		    $str .= " ";
		  else
		    $str .= $c[0];  

		  $strn .= $c[0];
		  $pt ++;
		  $c = $this->str[$pt].$this->str[$pt+1];
		}

	      $str .= "  ";
	      $strn .= "*/";
	      $pt += 2;

	      $n = &new node($ndr, COMMENT, $svpt, $strn);
	      $this->nodea[] = $n;

	      for ($i=$svpt; $i<$svpt+strlen($strn); $i++)
		$this->nodepos[$i] = $n->id;
	    }

	  else 
	    {
	      /*  if ($c[0] == "#")
		{
		  while(!$this->is_CR($c[0]) && ($pt < $this->lg))
		    {
		      $str .= " ";
		      $pt ++;
		      $c = $this->str[$pt].$this->str[$pt+1];
		    }
		}
	      */
	      
	      $str .= $c[0];
	      $pt++;
	    }
	}

      $this->str = $str;
    }

  function &get_node($id)
    {
      $ret = &$this->nodeid[$id];
      return $ret;
    }

  function tag_displayed($id)
    {
      $node = &$this->get_node($id);
      $node->dsp = true;     
    }

  function set_end($id, $end)
    {
      if (trim($end) == "")
	return;
      $this->nodeid[$id]->end = rtrim($end);

    }

  function in_comment()
    {
      $id = $this->nodepos[$this->pt];
      if ($id == -1)
	return false;

      $nd = & $this->nodeid[$id];
      if ($nd->type==COMMENT)
	return true;

      return false;
    }

  // retourne tous les elements qui doivent
  // etre affiche avec l'element passe
  function get_textnode(&$nds)
    {
      $ret = array();
      $pt = $nds[0]->pt;

      foreach ($nds as $ndo)
	{
	  $dum = substr(&$this->str, $pt, $ndo->pt-$pt);
	  if ($dum!="") 
	    {
	      $ret[] = array($ndo->id, $dum);
	      $pt += strlen($dum);
	    }

	  if ($ndo->type == COMMENT)
	    {
	      $ret[] = array($ndo->id, $ndo->tok);
	      continue;
	    }

	  $end=$pt+strlen($ndo->tok);
	  
	  // cherche les commentaires 
	  // incrustes
	  $nf = -1;
	  for ($i=$pt; $i<$end; $i++)
	    {
	      $ndid = $this->nodepos[$i];
	      if ($ndid != $nf)
		{
		  $nd = &$this->nodeid[$ndid];
		  $lg = strlen($nd->tok);
		  
		  if ($nd->type== COMMENT)
		    {
		      $ndid = $this->nodepos[$i];
		      if ($nd->pt-$pt > 0)
			{
			  $ret[] = array($ndo->id, substr(&$this->str, $pt, $nd->pt-$pt));
			  $pt += $nd->pt-$pt;
			}
		      $ret[] = array($nd->id, $nd->tok);
		      $pt += $lg;
		      $nf = $ndid;
		    }
		  $i += $lg;
		}
	    }
	  
	  $ret[] = array($ndo->id, substr(&$this->str, $pt, $end-$pt));
	  $pt = $end;
	}

      return $ret;
    }

  function is_space($c) 
    {

      if ($c == " " || $c == "\t")
	return true;
      return false;
    }
  
  function is_CR($c) 
    {

      //if ($c=="\r" || $c=="\n" || $c=="\f")
      if ($c=="\n" || $c=="\f")
	return true;
      return false;
    }
  
  function is_S($c) 
    {

      if ($this->is_space($c) || $this->is_CR($c))
	return true;
      return false;
    }
  
 
  function skip_Ss($nbmin=1) 
    {

      $svpt = $this->pt;

      $nb = 0;
      while (true)
	{
	  $c = $this->str[$this->pt];
	  if ($this->is_S($c))
	    { 
	      if (!$this->incpt(1))
		return 0;
	      $this->tok .= $c;
	      $nb ++;
	    }
	  else
	    break;
	}

      if ($nb >= $nbmin)
	return $nb;

      $this->pt = $svpt;
      return 0;
    }
  
  function clean_tok() 
    {

      $this->stop = false;
      $this->tok = "";
    }
  
  function incpt($inc)
    {

      $svpt = $this->pt;
      $this->pt += $inc;
      if ($this->pt >= $this->lg+1)
	{
	  $this->pt = $svpt;
	  $this->end = true;
	  return false;
	}
      return true;
    }

  function rett($fn, $ln) 
    {
      return true;
    }

  function ret_f($svpt, $fn, $ln) 
    {

      $this->pt = $svpt;
      return false;
    }

  function retf($fn, $ln) 
    {
      return false;
    }
  
  function ret_fn($svpt, $fn, $ln) 
    {

      $this->pt = $svpt;
      return false;
    }
  
  // return an error node with
  // end of line
  function &err_node(&$ndtr, $fn, $svpt, $ln) 
    {
      $nid = $ndtr->id;

      if ($this->end == true)
	{
	  return false;
	}

      $this->pt = $svpt;
      $this->clean_tok();

      //$c = $this->getc();
      //$this->tok .= $c;

      $c = $this->getc();
      while ((!$this->is_CR($c)) && ($c != "}") && ($c != ";")
	     && !$this->in_comment() )
	{
	  $this->tok .= $c;
	  
	  $c = $this->getc();
	  if (gettype($c) == "boolean")
	    break;
	}

      $this->pt --;

      $n = &new node($ndtr, ERROR, $svpt, $this->tok);
      return $n;
    }
  
  function getc()
    {

      if ($this->pt <= $this->lg)
	{
	  $c = $this->str[$this->pt];
	  if (!$this->incpt(1))
	    return false;
	  return $c;
	}

      return false;
    }

  // Grammar
  
  function parse() 
    {

      $ret = true;
      if (count($this->nodea) == 0)
	{
	  $root = new node($a, ROOT, 0, "");
      
	  $this->nodea[] = $root;
	  $this->erase_comments($root);
	  $this->skip_Ss();
	  
	  $a = -1;
	  if ($n = $this->is_stylesheet($root))
	    {
	      $this->nodea[] = $n;
	      $ret = $this->rett(&$fn,__LINE__);
	    }
	  else
	    $ret = $this->retf(&$fn, __LINE__);
	}

      if ($ret == true)
	{
	  $this->nodeid = $this->nodea;
	  usort($this->nodeid, "node_sort_id");
	}

      return $ret;
    }
  
  function &is_header(&$ndtr)
    {
      $n = &$this->is_import($ndtr);
      if ($n != false)
	return $n;
      
      $n = &$this->is_namespace($ndtr);
      return $n;
    }

  function &is_stylesheet(&$ndtr) 
    {
      $nid = $ndtr->id;


      $svpt = $this->pt;
      $this->clean_tok();

      $this->skip_Ss();

      $nr = &new node($ndtr, STYLESHEET, $svpt);

      if ($n = &$this->is_stylesheet_1($nr))
	$this->nodea[] = $n;
      $this->skip_Ss();
      
      while (($n = &$this->is_header($nr)) != false)
	{
	  $this->nodea[] = $n;
	  $this->skip_Ss();
	}

      while(true)
	{
	  $svpt = $this->pt;
	  $this->skip_Ss();

	  $n = &$this->is_ruleset($nr);
	  if ($n == false)
	    $n = &$this->is_media($nr);
	  if ($n == false)
	    $n = &$this->is_page($nr);
	  if ($n == false)
	    $n = &$this->is_font_face($nr);

	  if ($n == false)
	    {
	      if ($this->end == true)
		break;
	      else
		{
		  while ($this->is_S($this->str[$svpt]))
		    $svpt ++;

		  $n = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
		  $this->pt ++;
		}
	    }

	  $this->nodea[] = $n;
	}

      return $nr;
    }
  
  function &is_stylesheet_1(&$ndtr) 
    {
      $nid = $ndtr->id;


      $svpt = $this->pt;
      $this->clean_tok();

      if (!$this->is_CHARSET_SYM())
	return($this->ret_fn($svpt, &$fn, __LINE__));
      
      $this->skip_Ss();

      if (!$this->is_STRING())
	return($this->ret_fn($svpt, &$fn, __LINE__));
      
      $this->skip_Ss();

      $c = $this->str[$this->pt];
      if ($c != ";")
	return($this->ret_fn($svpt, &$fn, __LINE__));

      $n = &new node($ndtr, CHARSET_SYM, $svpt);
      return $n;
    }
  
  function &is_import(&$ndtr) 
    {
      $nid = $ndtr->id;


      $svpt = $this->pt;
      $this->clean_tok();
      
      if (!$this->is_IMPORT_SYM())
	return($this->ret_fn($svpt,&$fn,__LINE__));
      
      $this->skip_Ss();

      $ret = $this->is_URI();
      if ($ret == false)
	$ret = $this->is_STRING();
      if ($ret == false)
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return($ret);
	}
      
      $this->skip_Ss();

      if ($this->is_medium())
	{
	  while(true)
	    {
	      $c = $this->getc();
	      if ($c != ",")
		break;

	      $this->skip_Ss();
	      if (!$this->is_medium())
		{
		  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
		  return($ret);
		}
	    }
	}
      else
	$c = $this->getc();
      
      if ($c != ";")
	{
	  $n = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	}
      else
	$n = &new node($ndtr, IMPORT, $svpt, $this->tok);

      $this->skip_Ss();
      return $n;
    }

  function &is_namespace(&$ndtr) 
    {
      $nid = $ndtr->id;


      $svpt = $this->pt;
      $this->clean_tok();
      
      if (!$this->is_NAMESPACE_SYM())
	return($this->ret_fn($svpt,&$fn,__LINE__));
      
      $this->skip_Ss();

      $ret = $this->is_URI();
      if ($ret == false)
	$ret = $this->is_STRING();
      if ($ret == false)
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return($ret);
	}
      
      $this->skip_Ss();

      if ($this->is_medium())
	{
	  while(true)
	    {
	      $c = $this->getc();
	      if ($c != ",")
		break;

	      $this->skip_Ss();
	      if (!$this->is_medium())
		{
		  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
		  return($ret);
		}
	    }
	}
      else
	$c = $this->getc();
      
      if ($c != ";")
	{
	  $n = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	}
      else
	$n = &new node($ndtr, NAMESPACE, $svpt, $this->tok);

      $this->skip_Ss();
      return $n;
    }
  
  function &is_media(&$ndtr) 
    {
      $nid = $ndtr->id;


      $svpt = $this->pt;
      $this->clean_tok();
      
      if (!$this->is_MEDIA_SYM())
	return($this->ret_fn($svpt,&$fn,__LINE__));
      
      $this->skip_Ss();
      if (!$this->is_medium())
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return($ret);
	}

      $this->tok .= " ";
      
      $loop = true;
      while($loop)
	{
	  $c = $this->getc();
	  if ($c != ",")
	    break;

	  $this->skip_Ss();

	  if (!$this->is_medium())
	    {
	      $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	      return($ret); 
	    }

	  $this->tok .= " ";
	}
      
      if ($c != "{")
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $n = &new node($ndtr, MEDIA, $svpt, $this->tok);
      
      $loop = true;
      while($loop)
	{
	  $this->skip_Ss();

	  $nn = &$this->is_ruleset($ndtr);

	  if ($nn == false)
	    break;
	  else
	    $this->nodea[] = $nn;
	}
      
      if ($c != "}")
	{
	  $ret =  &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $this->skip_Ss();
      return $n;
    }
  
  function &is_page(&$ndtr) 
    {
      $nid = $ndtr->id;


      $this->clean_tok();
      $svpt = $this->pt;
      
      if (!$this->is_PAGE_SYM())
	return($this->ret_fn($svpt,&$fn,__LINE__));
      
      $this->skip_Ss();

      $r1 = $this->is_IDENT();
      $r2 = $this->is_pseudo_page();
      if ($r1 != false || $r2 != false)
	$this->skip_Ss();
      
      if ($c != "{")
	{
	  $ret =  &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $n = &new node($ndtr, PAGE, $svpt, $this->tok);     
      $this->skip_Ss();
      
      $nn = &$this->is_declaration($n);
      $this->nodea[] = $nn;
      
      $loop = true;
      while($loop)
	{
	  $c = $this->getc();
	  if ($c == "}")  // != ";"
	    break;

	  $this->skip_Ss();

	  $c = $this->getc();
	  if ($c == "}")
	    break;
	  
	  $this->pt --;
	  $nn = &$this->is_declaration($n);

	  $this->nodea[] = $nn;
	}
      
      if ($c != "}")
	{	  
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $this->skip_Ss();
      return $n;
    }
  
  function is_pseudo_page() // !node
    {


      $svpt = $this->pt;    
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));

      $c = $this->getc();

      if ($c != ':')
	return($this->ret_f($svpt, &$fn, __LINE__));

      $this->tok .= $c;

      if (!$this->is_IDENT())
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }
  
  function &is_font_face(&$ndtr) 
    {
      $nid = $ndtr->id;


      $this->clean_tok();
      $svpt = $this->pt;
      
      if (!$this->is_FONT_FACE_SYM())
	return($this->ret_fn($svpt,&$fn,__LINE__));
      
      $this->skip_Ss();
      
      if ($c != "{")
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $n = &new node($ndtr, FONTFACE, $svpt, $this->tok);     
      $this->skip_Ss();

      $nn = &$this->is_declaration($n);
      $this->nodea[] = $nn;
      
      $loop = true;
      while($loop)
	{
	  $c = $this->getc();
	  if ($c == "}")  // != ";"
	    break;

	  $this->skip_Ss();

	  $c = $this->getc();
	  if ($c == "}")
	    break;
	  
	  $this->pt --;
	  $nn = &$this->is_declaration($n);

	  $this->nodea[] = $nn;
	}    
      
      if ($c != "}")
	{
	  $ret =  &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $this->skip_Ss();
      return $n;
    }
  
  function is_operator() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));

      $c = $this->getc();

      if (($c != "/") && ($c != ","))
	return $this->ret_f($svpt, &$fn, __LINE__);
      
      $this->tok .= $c;
      $this->skip_Ss();    
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_combinator() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));

      $c = $this->getc();

      if (($c != "+") && ($c != ">"))
	return $this->ret_f($svpt, &$fn, __LINE__);
      
      $this->tok .= $c;
      $this->skip_Ss();    
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_unary_operator() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));

      $c = $this->getc();

      if (($c != "-") && ($c != "+"))
	return $this->ret_f($svpt, &$fn, __LINE__);
      $this->tok .= $c;
      
      $this->skip_Ss();    
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_property()  // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));

      if (!$this->is_IDENT())
	return $this->ret_f($svpt, &$fn, __LINE__);

      $this->skip_Ss();
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_ruleset(&$ndtr) 
    {
      $nid = $ndtr->id;


      $svpt = $this->pt;
      $this->clean_tok();

      if (!$this->is_selector())
	return($this->ret_fn($svpt,&$fn,__LINE__));
      
      while(true)
	{
	  $c = $this->getc();

	  if ($c != ",")
	    break;

	  $this->tok .= $c;
	  $this->skip_Ss();

	  if (!$this->is_selector())
	    return($this->ret_fn($svpt,&$fn,__LINE__));
	}
      
      if ($c != "{")
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $n = &new node($ndtr, RULESET, $svpt, $this->tok);    
      $this->skip_Ss();

      $nn = &$this->is_declaration($n);
      $this->nodea[] = $nn;
      
      while(true)
	{  
	  $c = $this->getc();
	  if ($c == "}")  // != ";"
	    break;

	  $this->skip_Ss();

	  $c = $this->getc();
	  if ($c == "}")
	    break;
	  
	  $this->pt --;
	  $nn = &$this->is_declaration($n);

	  $this->nodea[] = $nn;
	}    
      
      if ($c != "}")
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return ($ret);
	}

      $this->skip_Ss();
      return $n;
    }
  
  function is_medium() // !node
    {

      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));


      if ($this->is_IDENT())
	{
	  $this->skip_Ss();
	  return($this->rett(&$fn,__LINE__));
	}

      return($this->retf(&$fn, __LINE__));
    }
  
  function is_selector() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      if (!$this->is_simple_selector())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      while (true)
	{
	  $this->is_combinator();
	  
	  if (!$this->is_simple_selector())
	    break;
	}
      
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_simple_selector()  // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));

      $loop=0;
      if ($this->is_element_name())
	$loop = 1;
      
      while(true)
	{
	  if (!$this->is_HASH()
	      && !$this->is_class()
	      && !$this->is_attrib()
	      && !$this->is_pseudo() )
	    {
	      if ($loop == 0)
		return($this->ret_f($svpt, &$fn, __LINE__));
	      else
		break;
	    }
	  $loop ++;
	}
      
      $this->skip_Ss();
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_class() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $c = $this->getc();
      if ($c == ".")
	$this->tok .= ".";
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      if (!$this->is_IDENT())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_element_name() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $c = $this->getc();
      
      if ($c == "*")
	{
	  $this->tok .= "*";
	  return($this->rett(&$fn,__LINE__));
	}
      
      $this->pt = $svpt;
      if (!$this->is_IDENT())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_attrib() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $c = $this->getc();
      if ($c != "[")
	return($this->ret_f($svpt, &$fn, __LINE__));
      $this->tok .= "[";
      
      $this->skip_Ss();
      if (!$this->is_IDENT())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $this->skip_Ss();
      
      $prem = true;

      $c = $this->getc();
      if ($c == "=")
	$this->tok .= "=";
      else
	{
	  $this->pt --;
	  if (!$this->is_INCLUDES()
	      && !$this->is_DASHMATCH())
	    $prem=false;
	}
      
      $this->skip_Ss();

      if ($prem == true)
	{
	  if (!$this->is_IDENT()
	      && !$this->is_STRING())
	    return($this->ret_f($svpt, &$fn, __LINE__));
	  
	  $this->skip_Ss();
	}
      
      $c = $this->getc();
      if ($c != "]")
	return($this->ret_f($svpt, &$fn, __LINE__));
      $this->tok .= "]";
      
      return($this->rett(&$fn,__LINE__));
    }
  
  
  function is_pseudo() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $c = $this->getc();
      if ($c != ":")
	return($this->ret_f($svpt, &$fn, __LINE__));     
      $this->tok .= $c;

      if ($this->is_FUNCTION())
	{
	  $this->skip_Ss();

	  if (!$this->is_IDENT())
	    return($this->ret_f($svpt, &$fn, __LINE__));

	  $this->skip_Ss();
	  
	  $c = $this->getc();
	  if ($c != ")")
	    return($this->ret_f($svpt, &$fn, __LINE__));
	  $this->tok .= ")";

	  return($this->rett(&$fn,__LINE__));
	}
      
      if ($this->is_IDENT())
	return($this->rett(&$fn,__LINE__));
      
      return($this->ret_f($svpt, &$fn, __LINE__));
    }
  
  function is_declaration(&$ndtr) 
    {
      $nid = $ndtr->id;

      //$a = substr($this->str, $this->pt, 10);
      $this->clean_tok();

      // regler le pb de l'empty    
      $svpt = $this->pt;
      
      if (!$this->is_property())
	{
	  //return($this->ret_fn($svpt,$fn,__LINE__));
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return($ret);
	}

      $c = $this->getc();
      if ($c != ":")
	{
	  $this->pt--;
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return($ret);
	}
      $this->tok .= ":";
      
      $this->skip_Ss();
      if (!$this->is_expr())
	{
	  $ret = &$this->err_node($ndtr, &$fn, $svpt, __LINE__);
	  return($ret);
	}

      $this->is_prio();

      $n = &new node($ndtr, DECLARATION, $svpt, $this->tok);
      return($n);
    }
  
  function is_prio() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      if (!$this->is_IMPORTANT_SYM())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $this->skip_Ss();
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_expr()  // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      if (!$this->is_term())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      while(true)
	{
	  $this->is_operator();

	  if (!$this->is_term())
	    break;
	}

      if ($this->stop)
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));  
    }
  
  function is_term()  // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $uop = false;
      if ($this->is_unary_operator())
	$uop = true;
      
      if ($this->is_function_s())
	return($this->rett(&$fn,__LINE__));
      else 
	if ( $this->is_EMS()
	  || $this->is_EXS()
	  || $this->is_LENGTH()
	  || $this->is_ANGLE()
	  || $this->is_TIME()
	  || $this->is_FREQ()
	  || $this->is_DIMEN()
	  || $this->is_PERCENTAGE()
	   || $this->is_NUMBER() )
	{
	  $this->skip_Ss();
	  return($this->rett(&$fn,__LINE__));
	}

      if (!$uop)
	{
	  if ($this->is_STRING()
	      || $this->is_URI()
	      || $this->is_IDENT()
	      || $this->is_RGB()
	      || $this->is_UNICODERANGE() )
	    {
	      $this->skip_Ss();
	      return($this->rett(&$fn,__LINE__));
	    }
	  else if ($this->is_hexcolor())
	    return($this->rett(&$fn,__LINE__));
	}
            
      return($this->ret_f($svpt, &$fn, __LINE__));
    }
  
  function is_function_s() // !node
    {


      $svpt = $this->pt; 
      $svtok = $this->tok;

      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));    

      if (!$this->is_FUNCTION())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $this->skip_Ss();
      if (!$this->is_expr())
	{
	  $this->tok = $svtok;
	  return($this->ret_f($svpt, &$fn, __LINE__));
	}

      $c = $this->getc();
      if ($c != ")")
	{
	  $this->tok = $svtok;
	  return($this->ret_f($svpt, &$fn, __LINE__));
	}
      $this->tok .= ")";
      
      $this->skip_Ss();
      return($this->rett(&$fn,__LINE__));
    }
  
  function is_hexcolor() // !node
    {


      $svpt = $this->pt;
      if ($this->stop == true)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      if (!$this->is_HASH())
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $this->skip_Ss();
      return($this->rett(&$fn,__LINE__));
    }

  // ###########################
  // lexical scanner

  function is_CDO()
    {


      $svpt = $this->pt;

      $tok = "<!--";

      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));	    
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_CDC()
    {


      $svpt = $this->pt;

      $tok = "-->";
      //$str = substr(&$this->str, $this->pt, 3);
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_INCLUDES()
    {


      $svpt = $this->pt;

      $tok = "~=";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_DASHMATCH()
    {


      $svpt = $this->pt;

      $tok = "|=";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function &is_type($type, $lim="") 
    {


      if ($this->stop)
	return($this->retf(&$fn, __LINE__));

      if ($lim != "")
	$lim = "(".$lim.")";

      //$patt = "/^(".call_user_func(array($this, "patt_".$type)).")".$w."/si";
      $patt = "/^.{".$this->pt."}(".call_user_func(array($this, "patt_".$type)).")".$lim."(.*)/si";
      
      if (preg_match(&$patt, &$this->str, $arr))
	return $arr[1];
      else
	{
	  $ret = $this->retf(&$fn, __LINE__);
	  return($ret);
	}
    }

  function &is_2type($type1, $type2, $lim="") 
    {


      if ($this->stop)
	return($this->retf(&$fn, __LINE__));

      /*
      if ($lim != "")
	$w = $lim;
      else
	$w = "[ \t\r\n\f]*";
      */

      //$patt = "/^(".call_user_func("patt_".$type1.$type2).")".$w."/si";
      $patt = "/^.{".$this->pt."}(".call_user_func(array($this, "patt_".$type1)).
	call_user_func(array($this, "patt_".$type2)).")(.*)/si";

      //echo "patt=".$patt."\n";
      if (preg_match(&$patt, &$this->str, $arr))
	return $arr[1];
      else
	{
	  $ret = $this->retf(&$fn, __LINE__);
	  return($ret);
	}
    }

  function is_STRING()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      if ($tok = &$this->is_type("string"))
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_IDENT()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      if ($tok = &$this->is_type("ident"))
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_HASH()
    {


      $svpt = $this->pt;

      $c = $this->getc();
      if ($c != "#")
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $tok = "#";
      //$str = substr(&$this->str, $this->pt);

      if ($toks = &$this->is_type("name"))
	{
	  $this->tok .= $tok.$toks;
	  if (!$this->incpt(strlen($toks)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_IMPORT_SYM()
    {

      $svpt = $this->pt;

      $tok = "@import";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_NAMESPACE_SYM()
    {


      $svpt = $this->pt;

      $tok = "@namespace";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_PAGE_SYM()
    {


      $svpt = $this->pt;

      $tok = "@page";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_MEDIA_SYM()
    {


      $svpt = $this->pt;

      $tok = "@media";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_FONT_FACE_SYM()
    {


      $svpt = $this->pt;

      $tok = "@font-face";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_CHARSET_SYM()
    {


      $svpt = $this->pt;

      $tok = "@charset";
      $str = substr(&$this->str, $this->pt, strlen($tok));
      if (strcmp($tok, $str) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_ATKEYWORD()
    {


      $svpt = $this->pt;

      $c = $this->getc();
      if ($c != "@")
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      //$str = substr(&$this->str, $this->pt);

      if ($toks = &$this->is_type("ident"))
	{
	  $this->tok .= "@".$toks;
	  if (!$this->incpt(strlen($toks)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_IMPORTANT_SYM()
    {


      $svpt = $this->pt;

      $c = $this->getc();
      if ($c != "!")
	return($this->ret_f($svpt, &$fn, __LINE__));

      $this->tok .= "!";
      $this->skip_Ss();

      $tok = "important";
      $str = substr(&$this->str, $this->pt);
      if (strncmp($str, $tok, strlen($tok)) == 0)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_EMS()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      $tok = &$this->is_type("num", "em");
      $ret = (gettype($tok) == "string") ? true : false;

      if ($ret)
	{
	  $this->tok .= $tok."em";
	  if (!$this->incpt(strlen($tok)+2))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_EXS()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      $tok = &$this->is_type("num", "ex");
      $ret = (gettype($tok) == "string") ? true : false;

      if ($ret)
	{
	  $this->tok .= $tok."ex";
	  if (!$this->incpt(strlen($tok)+2))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }
  
  function is_LENGTH()
    {


      $svpt = $this->pt;

      //$str = substr(&$this->str, $this->pt);
      $mess = array("px", "cm", "mm", "in", "pt", "pc");

      foreach($mess as $mes)
	{
	  $tok = &$this->is_type("num", $mes);
	  $ret = (gettype($tok) == "string") ? true : false;

	  if ($ret)
	    {
	      $this->tok .= $tok.$mes;
	      if (!$this->incpt(strlen($tok.$mes)))
		return($this->ret_f($svpt, &$fn, __LINE__));
	      return($this->rett(&$fn,__LINE__));
	    }
	}

      return($this->ret_f($svpt, &$fn, __LINE__));
    }

  function is_ANGLE()
    {


      $svpt = $this->pt;

      //$str = substr(&$this->str, $this->pt);
      $mess = array("deg", "rad", "grad");

      foreach($mess as $mes)
	{
	  $tok = &$this->is_type("num", $mes);
	  $ret = (gettype($tok) == "string") ? true : false;

	  if ($ret)
	    {
	      $this->tok .= $tok.$mes;
	      if (!$this->incpt(strlen($tok)+strlen($mes)))
		return($this->ret_f($svpt, &$fn, __LINE__));
	      return($this->rett(&$fn,__LINE__));
	    }
	}

      return($this->ret_f($svpt, &$fn, __LINE__));
    }

  function is_TIME()
    {


      $svpt = $this->pt;

      //$str = substr(&$this->str, $this->pt);
      $mess = array("ms", "s");

      foreach($mess as $mes)
	{
	  $tok = &$this->is_type("num", $mes);
	  $ret = (gettype($tok) == "string") ? true : false;

	  if ($ret)
	    {
	      $this->tok .= $tok.$mes;
	      if (!$this->incpt(strlen($tok)+strlen($mes)))
		return($this->ret_f($svpt, &$fn, __LINE__));
	      return($this->rett(&$fn,__LINE__));
	    }
	}

      return($this->ret_f($svpt, &$fn, __LINE__));
    }

  function is_FREQ()
    {


      $svpt = $this->pt;

      //$str = substr(&$this->str, $this->pt);
      $mess = array("Hz", "kHz");

      foreach($mess as $mes)
	{
	  $tok = &$this->is_type("num", $mes);
	  $ret = (gettype($tok) == "string") ? true : false;

	  if ($ret)
	    {
	      $this->tok .= $tok.$mes;
	      if (!$this->incpt(strlen($tok)+strlen($mes)))
		return($this->ret_f($svpt, &$fn, __LINE__));
	      return($this->rett(&$fn,__LINE__));
	    }
	}

      return($this->ret_f($svpt, &$fn, __LINE__));
    }

  function is_DIMEN()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      $tok = &$this->is_2type("num", "ident");
      $ret = (gettype($tok) == "string") ? true : false;

      if ($ret)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_PERCENTAGE()
    {


      $svpt = $this->pt;

      //$str = substr(&$this->str, $this->pt);
      $mess = array("%");

      foreach($mess as $mes)
	{
	  $tok = &$this->is_type("num", $mes);
	  $ret = (gettype($tok) == "string") ? true : false;
      
	  if ($ret)
	    {
	      $this->tok .= $tok.$mes;
	      if (!$this->incpt(strlen($tok)+strlen($mes)))
		return($this->ret_f($svpt, &$fn, __LINE__));
	      return($this->rett(&$fn,__LINE__));
	    }
	}

      return($this->ret_f($svpt, &$fn, __LINE__));
    }

  function is_NUMBER()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      $tok = &$this->is_type("num");
      
      // $ret pour traiter le cas ou la
      // fonction renvoie "0"
      $ret = (gettype($tok) == "string") ? true : false;

      if ($ret)
	{
	  $this->tok .= $tok;
	  if (!$this->incpt(strlen($tok)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	return($this->ret_f($svpt, &$fn, __LINE__));

      return($this->rett(&$fn,__LINE__));
    }

  function is_URI()
    {


      $svpt = $this->pt;
      $str = substr(&$this->str, $this->pt);

      $tok = "url("; 
      if (strncmp($str, $tok, strlen($tok)) != 0)
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      $this->tok .= $tok;
      if (!$this->incpt(strlen($tok)))
	return($this->ret_f($svpt, &$fn, __LINE__));

      $this->skip_Ss();

      //$str = substr(&$this->str, $this->pt);
      if ($toks = &$this->is_type("string"))
	{
	  $this->tok .= $toks;
	  if (!$this->incpt(strlen($toks)))
	    return($this->ret_f($svpt, &$fn, __LINE__));
	}
      else
	{
	  $this->stop = true;
	  return($this->ret_f($svpt, &$fn, __LINE__));
	}

      $this->skip_Ss();

      $c = $this->getc();
      if ($c != ")")
	{
	  $this->stop = true;
	  return($this->ret_f($svpt, &$fn, __LINE__));
	}

      $this->tok .= ")";
      return($this->rett(&$fn,__LINE__));
    }

  function is_FUNCTION()
    {


      $svpt = $this->pt;
      //$str = substr(&$this->str, $this->pt);

      if (($tok = &$this->is_type("ident")) == false)
	return($this->ret_f($svpt, &$fn, __LINE__));

      if (!$this->incpt(strlen($tok)))
	return($this->ret_f($svpt, &$fn, __LINE__));

      if ($this->str[$this->pt] != "(")
	return($this->ret_f($svpt, &$fn, __LINE__));

      $this->tok .= $tok."(";
      if (!$this->incpt(1))
	return($this->ret_f($svpt, &$fn, __LINE__));
      
      return($this->rett(&$fn,__LINE__));
    }

  function is_RGB()
    {
      // A REVOIR


      return ($this->is_HASH());
    }

  function is_UNICODERANGE()
    {


      // A REVOIR
      return($this->retf(&$fn,__LINE__));
    }

  // patterns

  function patt_h()
    {

      return "[0-9a-f]";
    }
  
  function patt_nonascii()
    {

      return "[\200-\377]";
    }
  
  function patt_unicode()
    {

      $h = $this->patt_h();
      return "\\\\".$h."{1,6}[ \t\r\n\f]?";
    }
  
  function patt_escape()
    {

      $u = $this->patt_unicode();
      return $u."|\\\\[ -~\200-\377]";
    }
  
  function patt_nmstart()
    {
      global $li;

      $n = $this->patt_nonascii();
      $e = $this->patt_escape();
      if ($li)
	return "[a-z_]|".$n."|".$e;
      else
	return "[a-z]|".$n."|".$e;      
    }
  
  function patt_nmchar()
    {
      global $li;

      $n = $this->patt_nonascii();
      $e = $this->patt_escape();
      if ($li)
	return "[a-z0-9_-]|".$n."|".$e;
      else
	return "[a-z0-9-]|".$n."|".$e;
    }
  
  function patt_nl()
    {

      return "\n|\r\n|\r|\f";
    }
  
  function patt_w()
    {

      return "[ \t\r\n\f]*";
    }
  
  function patt_string1()
    {

      $nl = $this->patt_nl();
      $n = $this->patt_nonascii();
      $e = $this->patt_escape();
      return '\\"([\t !#$%&(-~]|\\\\'.$nl.'|\'|'.$n.'|'.$e.')*\\"';
    }
  
  function patt_string2()
    {

      $nl = $this->patt_nl();
      $n = $this->patt_nonascii();
      $e = $this->patt_escape();
      return "\\'([\t !#$%&(-~]|\\\\".$nl."|\"|".$n."|".$e.")*\\'";
    }
  
  function patt_ident()
    {

      $ns = $this->patt_nmstart();
      $nc = $this->patt_nmchar();
      return "(".$ns.")(".$nc.")*";
    }
  
  function patt_name()
    {

      $nm = $this->patt_nmchar();
      return "(".$nm.")+";
    }
  
  function patt_num()
    {
      $ret = "[0-9]*\.[0-9]+|[0-9]+";
      return $ret;
    }
  
  function patt_string()
    {

      $s1 = $this->patt_string1();
      $s2 = $this->patt_string2();
      return $s1."|".$s2;
    }
  
  function patt_url()
    {

      $n = $this->patt_nonascii();
      $e = $this->patt_escape();
      return "([!#$%&*-~]|".$n."|".$e.")*";
    }
  
  function patt_range()
    {

      $h = $this->patt_h();
      return "\\?{1,6}|".$h."(\?{0,5}|".$h."(\\?{0,4}|"
	.$h."(\\?{0,3}|".$h."(\\?{0,2}|".$h."(\\??|".$h.")))))";
    }
  
  /*
  function get_text()
    {
      usort($this->nodea, "node_sort_pt");
      
      $ptg = 0;
      $str = "";
      
      foreach($this->nodea as $node)
	{
	  $type = $node->type;
	  $id = $node->id;
	  $pid = $node->pid;
	  $pt = $node->pt;
	  $tok = $node->tok;
	  $delta = $node->delta;

	  if ($tok == "")
	    continue;
	  
	  $str .= substr($this->str, $ptg, $pt-$ptg);
	  $ptg += $pt-$ptg;
	  $str .= $tok;
	  
	  $ptg += strlen($tok) - $delta;
	}
      
      $str .= substr($this->str, $ptg);
      return $str;
    }
  */

  function get_html($nid)
    {

      usort($this->nodea, "node_sort_pt");
      $ptg = 0;
      $str = "";

      // recupere la fin des tokens 
      // pour l'afficher
      $oldnode = false;
      foreach($this->nodea as $node)
	{
	  if ($node->type == COMMENT)
	    continue;

	  if ($oldnode != false)
	    {
	      $pt = $oldnode->pt+strlen($oldnode->tok);
	      $this->set_end($oldnode->id, substr(&$this->str, $pt, $node->pt - $pt));
	    }
	  $oldnode = $node;
	}
      $pt = $oldnode->pt+strlen($oldnode->tok);
      $this->set_end($oldnode->id, substr(&$this->str, $pt, $this->lg - $pt));

      //print_r($this->nodeid);exit;

      foreach($this->nodea as $nd)
	{
	  $node = &$this->get_node($nd->id);

	  if ($node->tok == "")
	    continue;
	  
	  if ($node->dsp == true)
	    continue;

	  $pt = $node->pt;

	  // affiche jusqu'au debut du token suivant
	  $str .= nl2br(str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;",
		    str_replace(" ", "&nbsp;", substr(&$this->str, $ptg, $pt-$ptg))));
	  $ptg += $pt-$ptg;
	  
	  $inclic = false;

	  $nds = array();
	  $nds[] = $node;

	  $end = $node->end;
	  // recupere tous les noeuds dans le cas où
	  // le noeud clique a de la descendance 
	  if ( ($nid == $node->id)&& 
	       ( ($node->type==IMPORT) ||
		 ($node->type==RULESET) ||
		 ($node->type==MEDIA) ||
		 ($node->type==FONTFACE) ||
		 ($node->type==PAGE) ) )
	    {
	      // dans ce cas, on recupere tous les 
	      // fils de l'element pour les afficher
	      foreach($node->sons as $sonid)
		{
		  $ndd = &$this->nodeid[$sonid];
		  $nds[] = $ndd;
		  $end = $ndd->end;
		}
	    }
	  
	  $sts = $this->get_textnode($nds);  

	  // regarde si on a clique dans 
	  // une commentaire entoure
	  foreach($sts as $st)
	    {
	      if ($st[0] == $nid)
		{

		  $inclic = true;
		  break;
		}
	    }

	  // clic => edite le tag
	  if ($inclic)
	    {
	      $lstr = "";
	      foreach($sts as $st)
		{
		  $ndl = &$this->get_node($st[0]);
		  $lstr .= $st[1];
		  $this->tag_displayed($ndl->id);
		  //$ptg += strlen($st[1]);
		}

	      // ajouter la fin de ligne

	      $lstr .= $end;
	      $str .= $node->get_html_editable($lstr);
	      $ptg += strlen($lstr);
	    }
	  else
	    {
	      foreach($sts as $st)
		{
		  $ndl = &$this->get_node($st[0]);
		  $str .= nl2br($ndl->get_html($st[1]));
		  $this->tag_displayed($ndl->id);
		  $ptg += strlen($st[1]);
		}
	    }
	}
      
      // fin du fichier
      $str .= nl2br(substr(&$this->str, $ptg));
      return $str;
    }
  
};


function get_css($cd)
{
  $ret = array('--not selected--');

  $handle = @opendir($cd);

  while (($fichier = @readdir($handle)) != '')
    {
      // Eviter ".", "..", ".htaccess", etc.
      if ($fichier[0] == '.') continue;
      if ($fichier == 'CVS') continue;

      $nom_fichier = $cd."/".$fichier;
      if (@is_file($nom_fichier))
        {
          if (!ereg("^(.+)\.css$", $fichier, $extlg))
            continue;
	  $ret[] = $fichier;
        }
    }
  @closedir($handle);

  return $ret;
}

function get_dirs($cd)
{
  $cd = @realpath($cd);
  $ret = array();

  $handle = @opendir($cd);

  while (($fichier = @readdir($handle)) != '')
    {
      $nom_fichier = $cd."/".$fichier;
      if (@is_dir($nom_fichier))
	$ret[] = $fichier;
    }
  @closedir($handle);

  return $ret;
}

function check_file($file)
{
  if ($file=="") 
    return false;

  // mettre ici le type de fichier accepte
  $fv = array("css");
                                                                                                    
  $found = false;
  foreach($fv as $format)
    {
      $patt = "/^(.*).".$format."$/";
      if (preg_match($patt, $file))
        {
          $found = true;
	  break;
        }
    }
  return $found;
}

// main 
{
  global $debut, $fin1, $fin2;

  //set_time_limit(0);
  $debut = time();

  if (isset($view) || isset($view_x))
    {
      view($type,$val,$nbrows);
      exit;
    }
  
  if (isset($image))
    {
      return_image($image);
      exit;
    }

  if (!isset($cd))
    $cd = ".";

  $fcss = get_css($cd); 
  if (!isset($file))
    $file = $fcss[0];

  if (!isset($nid) || isset($cancel) || isset($cancel_x))
    $nid = -1;

  if (!isset($xw))
    $xw = 0;

  if (!isset($yw))
    $yw = 0;

  $page = "";

  $watt = true;

  if (@is_file($cd."/".$file) && check_file($file))
    {
      if (($nid!=-1) && (isset($ok)||isset($ok_x)) && isset($nval))
	{
	  if (!reset_css($nid, $ptnid, $oldlen, $nval, $cd, $file))
	    $watt = false;
	  else
	    $nid = -1;
	}

      $css = "";
      $rp = realpath($cd."/".$file);
      $p = &new css($rp);

      
      if ($nid==0)
	{
	  $root = new node($a, ROOT, 0, "");
	  $page = $root->get_html_editable($p->str);
	}
      else if ($p->parse() == true)  
	{
	  $fin1 = time();
	  // print_r($p->nodea);
	  // exit;
	  $page = $p->get_html($nid);      
	}
      else
	$page = "CSS non valide... impossible de eledicss";
    }
  else
    $page = "aucun fichier selectionne...";

  $fin2 = time();
  display_page(&$page, $cd, $fcss, $xw, $yw, $nid, $watt);
  
  exit;
}


function reset_css($nid, $ptnid, $oldlen, $nval, $cd, $file)
{
  $fn = $cd."/".$file;
  $fd = fopen($fn, "r");
  $str = fread($fd, filesize($fn));
  fclose($fd);

  $res = substr(&$str, 0, $ptnid);
  $dum = str_replace("\r", "", rtrim(stripslashes($nval)));
  $res .= $dum;
  $res .= substr(&$str, $ptnid + $oldlen);
  
  $fd = @fopen($fn, "w");
  if ($fd)
    {
      fwrite($fd, $res, strlen($res));
      fclose($fd);
      return true;
    }
  
  return false;
}


function get_vals($type,$tok)
{
  switch($type)
    {
    case RULESET:
      $ret = get_ruleset();
      break;
    default:
      $ret = get_property($tok);
      $ret = array_merge($ret, array("inherit"));
      break;
    }
  return $ret;
}

function get_ruleset()
{
  $ret = array('length','time','frequency','color','uri','percentage','shape',
	       'string','generic-family','family-name','absolute-size','relative-size',
	       'azimuth' ,'background' ,'background-attachment' ,'background-color' ,
	       'background-image' ,'background-position','background-repeat','border',
	       'border-collapse','border-color','border-spacing','border-style',
	       'border-top','border-right','border-bottom','border-left','border-top-color',
	       'border-right-color','border-bottom-color','border-left-color','border-top-style',
	       'border-right-style','border-bottom-style','border-left-style','border-top-width',
	       'border-right-width','border-bottom-width','border-left-width','border-width',
	       'bottom','caption-side','clear','clip','content','counter','counter-increment',
	       'counter-reset','cue','cue-after','cue-before','cursor','direction','display',
	       'elevation','empty-cells','float','font','font-family','font-size','font-size-adjust',
	       'font-stretch','font-style','font-variant','font-weight','height','left',
	       'letter-spacing','line-height','list-style','list-style-image',
	       'list-style-position','list-style-type','margin','margin-top','margin-right',
	       'margin-bottom','margin-left','marker-offset','marks','max-height',
	       'max-width','min-height','min-width','orphans','outline','outline-color',
	       'outline-style','outline-width','overflow','padding','padding-top',
	       'padding-right','padding-bottom','padding-left','padding-width','page',
	       'page-break-after','page-break-before','page-break-inside','pause','pause-after',
	       'pause-before','pitch','pitch-range','play-during','position','quotes','richness',
	       'right','size','speak','speak-header','speak-numeral','speak-punctuation',
	       'speech-rate','stress','table-layout','text-align','text-decoration',
	       'text-indent','text-shadow','text-transform','top','unicode-bidi','vertical-align',
	       'visibility','specific-voice','generic-voice','voice-family','volume','white-space',
	       'widows','width','word-spacing','z-index');
  return $ret;
}

function get_property($tok)
{
  $ret = array();

  switch($tok)
    {
    case 'length':
      $ret = array("XXpx","XXcm","XXmm","XXin","XXpt","XXpc");
      break;
    case 'time':
      $ret = array("XXms","XXs");
      break;
    case 'frequency':
      $ret = array("XXHz","XXkHz");
      break;
    case 'color':
      $ret = array("aqua","black","blue","fuchsia","gray","green",
		   "lime","maroon","navy","olive","purple","red",
		   "silver","teal","white","yellow",
		   "#RGB", "#RRGGBB", "rgb(RR,GG,BB)","rgb(RR%,GG%%,BB%)");
      break;
    case 'uri':
      $ret = array("url('http://XX')","url(\"http://XX\")","url(http://XX)");
      break;
    case 'percentage':
      $ret = array("XX%");
      break;
    case 'shape':
      $ret = array("rect(XXpx YYpx LLpx HHpx)");
      break;
    case 'string':
      $ret = array("\"XX\"", "'XX'");
      break;
    case 'generic-family':
      $ret = array("serif","sans-serif","cursive","fantasy","monospace");
      break;
    case 'family-name':
      $ret = array("");
      break;
    case 'absolute-size':
      $ret = array("xx-small","x-small","small","medium","large","x-large","xx-large");
      break;
    case 'relative-size':
      $ret = array("larger","smaller");
      break;

    case 'azimuth' :
      $ret = get_property("angle");
      $ret = array_merge($ret, array("left-side","far-left","left",
		     "center-left","center","center-right","right",
		     "far-right","right-side ]"," behind ]","leftwards","rightwards","inherit"));
      break;
    case 'background' :
      $ret = get_property("background-color");
      $ret = array_merge($ret, get_property("background-image"));
      $ret = array_merge($ret, get_property("background-repeat"));
      $ret = array_merge($ret, get_property("background-attachment"));
      $ret = array_merge($ret, get_property("background-position"));
      break;
    case 'background-attachment' :
      $ret=array("scroll","fixed");
      break;
    case 'background-color' :
      $ret = get_property("color");
      $ret = array_merge($ret, array("transparent"));
      break;
    case 'background-image' :
      $ret = get_property("uri");
      $ret = array_merge($ret, array("none"));
      break;
    case 'background-position':
      $ret = get_property("percentage");
      $ret = array_merge($ret, array("length"));
      $ret = array_merge($ret, array("top","center","bottom","left","right"));
      break;
    case 'background-repeat':
      $ret = array("repeat","repeat-x","repeat-y","no-repeat");
      break;
    case 'border':
      $ret = get_property("border-width");
      $ret = array_merge($ret, get_property("border-style"));
      $ret = array_merge($ret, get_property("color"));
      break;
    case 'border-collapse':
      $ret=array("collapse","separate");
      break;
    case 'border-color':
      $ret = get_property("color");
      $ret = array_merge($ret, array("transparent"));      
      break;
    case 'border-spacing':
      $ret = get_property("length");
      break;
    case 'border-style':
      $ret=array("none","hidden","dotted","dashed","solid","double",
		 "groove","ridge","inset","outset");
      break;
    case 'border-top':
    case 'border-right':
    case 'border-bottom':
    case 'border-left':
      $ret = get_property("border-top-width");
      $ret = array_merge($ret, get_property("border-style"));
      $ret = array_merge($ret, get_property("color"));
      break;
    case 'border-top-color':
    case 'border-right-color':
    case 'border-bottom-color': 
    case 'border-left-color':
      $ret = get_property("color");
      break;
    case 'border-top-style':
    case 'border-right-style':
    case 'border-bottom-style':
    case 'border-left-style':
      $ret = get_property("border-style");
      break;
    case 'border-top-width':
    case 'border-right-width':
    case 'border-bottom-width':
    case 'border-left-width':
      $ret = get_property("border-width");
      break;
    case 'border-width':
      $ret = array("thin","medium","thick");
      $ret = array_merge($ret, get_property("length"));
      break;
    case 'bottom':
      $ret = get_property("length");
      $ret = array_merge($ret, get_property("percentage"));
      $ret = array_merge($ret, array("auto"));
      break;
    case 'caption-side':
      $ret=array("top","bottom","left","right");
      break;
    case 'clear':
      $ret=array("none","left","right","both");
      break;
    case 'clip':
      $ret = get_property("shape");
      $ret = array_merge($ret, get_property("auto"));
      break;
    case 'content':
      $ret = get_property("string");
      $ret = array_merge($ret, get_property("uri"));
      $ret = array_merge($ret, get_property("counter"));
      $ret = array_merge($ret, array("attr(X)","open-quote","close-quote","no-open-quote","no-close-quote"));
      break;
    case 'counter':
      $ret = array("counter(id)","counter(id,disc)","counter(id,circle","...");
      break;
    case 'counter-increment':
      $ret=array("id","id num","none");
      break;
    case 'counter-reset':
      $ret=array("id","id num","none");
      break;
    case 'cue':
      $ret = get_property("cue-before");
      $ret = array_merge($ret, get_property("cue-after"));
      break;
    case 'cue-after':
    case 'cue-before':
      $ret = get_property("uri");
      $ret = array_merge($ret, array("none"));
      break;
    case 'cursor':
      $ret = get_property("uri");
      $ret = array_merge($ret, array("auto","crosshair","default","pointer","move","e-resize","ne-resize","nw-resize","n-resize","se-resize","sw-resize","s-resize","w-resiz","text","wait","help"));
      $ret=array();
      break;
    case 'direction':
      $ret=array("ltr","rtl");
      break;
    case 'display':
      $ret=array("inline","block","list-item","run-in","compact","marker","table","inline-table","table-row-group","table-header-group","table-footer-group","table-row","table-column-group","table-column","table-cell","table-caption","none");
      break;
    case 'elevation':
      $ret = get_property("angle");
      $ret = array_merge($ret, array("below","level","above","higher","lower"));
      break;
    case 'empty-cells':
      $ret=array("show","hide");
      break;
    case 'float':
      $ret=array("left","right","none");
      break;
    case 'font':
      $ret = get_property("font-style");
      $ret = array_merge($ret, get_property("font-variant"));
      $ret = array_merge($ret, get_property("font-weight"));
      $ret = array_merge($ret, get_property("font-size"));
      $ret = array_merge($ret, get_property("line-height"));
      $ret = array_merge($ret, get_property("font-family"));
      $ret = array_merge($ret, array("caption","icon","menu","message-box","small-caption","status-bar"));
      break;
    case 'font-family':
      $ret = get_property("family-name");
      $ret = array_merge($ret, get_property("generic-family"));
      break;
    case 'font-size':
      $ret = get_property("absolute-size");
      $ret = array_merge($ret, get_property("relative-size"));
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'font-size-adjust':
      $ret=array("XX","none");
      break;
    case 'font-stretch':
      $ret=array("normal","wider","narrower","ultra-condensed","extra-condensed","condensed","semi-condensed","semi-expanded","expanded","extra-expanded","ultra-expanded");
      break;
    case 'font-style':
      $ret=array("normal","italic","oblique");
      break;
    case 'font-variant':
      $ret=array("normal","small-caps");
      break;
    case 'font-weight':
      $ret=array("normal","bold","bolder","lighter","100","200","300","400","500","600","700","800","900");
      break;
    case 'height':
      $ret=array("auto");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'left':
      $ret=array("auto");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'letter-spacing':
      $ret=array("normal");
      $ret = array_merge($ret, get_property("length"));
      break;
    case 'line-height':
      $ret=array("normal","XX");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'list-style':
      $ret=array();
      $ret = array_merge($ret, get_property("list-style-type"));
      $ret = array_merge($ret, get_property("list-style-position"));
      $ret = array_merge($ret, get_property("list-style-image"));
      break;
    case 'list-style-image':
      $ret=array("none");
      $ret = array_merge($ret, get_property("uri"));
      break;
    case 'list-style-position':
      $ret=array("inside","outside");
      break;
    case 'list-style-type':
      $ret=array("disc","circle","square","decimal","decimal-leading-zero","lower-roman","upper-roman","lower-greek","lower-alpha","lower-latin","upper-alpha","upper-latin","hebrew","armenian","georgian","cjk-ideographic","hiragana","katakana","hiragana-iroha","katakana-iroha","none");
      break;
    case 'margin':
      $ret = array_merge($ret, get_property("margin-width"));
      break;
    case 'margin-top':
    case 'margin-right':
    case 'margin-bottom':
    case 'margin-left':
      $ret = array_merge($ret, get_property("margin-width"));
      break;
    case 'marker-offset':
      $ret = array("auto");
      $ret = array_merge($ret, get_property("length"));
      break;
    case 'marks':
      $ret=array("crop","cross","none");
      break;
    case 'max-height':
      $ret=array("none");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'max-width':
      $ret=array("none");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'min-height':
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'min-width':
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'orphans':
      $ret=array("XX");
      break;
    case 'outline':
      $ret = array_merge($ret, get_property("outline-color"));
      $ret = array_merge($ret, get_property("outline-style"));
      $ret = array_merge($ret, get_property("outline-width"));
      break;
    case 'outline-color':
      $ret=array("invert");
      $ret = array_merge($ret, get_property("color"));
      break;
    case 'outline-style':
      $ret = array_merge($ret, get_property("border-style"));
      break;
    case 'outline-width':
      $ret = array_merge($ret, get_property("border-width"));
      break;
    case 'overflow':
      $ret=array("visible","hidden","scroll","auto");
      break;
    case 'padding':
      $ret = array_merge($ret, get_property("padding-width"));
      break;
    case 'padding-top':
    case 'padding-right':
    case 'padding-bottom':
    case 'padding-left':
      $ret = array_merge($ret, get_property("padding-width"));
      break;
    case 'padding-width':
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'page':
	$ret=array("id","auto");
      break;
    case 'page-break-after':
      $ret=array("auto","always","avoid","left","right");
      break;
    case 'page-break-before':
      $ret=array("auto","always","avoid","left","right");
      break;
    case 'page-break-inside':
      $ret=array("avoid","auto");
      break;
    case 'pause':
      $ret = array_merge($ret, get_property("time"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'pause-after':
      $ret = array_merge($ret, get_property("time"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'pause-before':
      $ret = array_merge($ret, get_property("time"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'pitch':
      $ret=array("x-low","low","medium","high","x-high");
      $ret = array_merge($ret, get_property("frequency"));
      break;
    case 'pitch-range':
      $ret=array("XX");
      break;
    case 'play-during':
      $ret=array("mix","repeat","auto","none");
      $ret = array_merge($ret, get_property("uri"));
      break;
    case 'position':
      $ret=array("static","relative","absolute","fixed");
      break;
    case 'quotes':
      $ret=array("none");
      $ret = array_merge($ret, get_property("string"));
      break;
    case 'richness':
      $ret=array("XX");
      break;
    case 'right':
      $ret=array("auto");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'size':
      $ret=array("auto","portrait","landscape");
      $ret = array_merge($ret, get_property("length"));
      break;
    case 'speak':
      $ret=array("normal","none","spell-out");
      break;
    case 'speak-header':
      $ret=array("once","always");
      break;
    case 'speak-numeral':
      $ret=array("digits","continuous");
      break;
    case 'speak-punctuation':
      $ret=array("code","none");
      break;
    case 'speech-rate':
      $ret=array("XX","x-slow","slow","medium","fast","x-fast","faster","slower");
      break;
    case 'stress':
      $ret=array("XX");
      break;
    case 'table-layout':
      $ret=array("auto","fixed");
      break;
    case 'text-align':
      $ret=array("left","right","center","justify");
      $ret = array_merge($ret, get_property("string"));
      break;
    case 'text-decoration':
      $ret=array("none","underline","overline","line-through","blink");
      break;
    case 'text-indent':
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'text-shadow':
      $ret=array("none");
      $ret = array_merge($ret, get_property("color"));
      $ret = array_merge($ret, get_property("length"));
      break;
    case 'text-transform':
      $ret=array("capitalize","uppercase","lowercase","none");
      break;
    case 'top':
      $ret=array("auto");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'unicode-bidi':
      $ret=array("normal","embed","bidi-override");
      break;
    case 'vertical-align':
      $ret=array("baseline","sub","super","top","text-top","middle","bottom","text-bottom");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'visibility':
      $ret=array("visible","hidden","collapse");
      break;
    case 'specific-voice':
      $ret=array("comedian","trinoids","carlos","lan");
      break;
    case 'generic-voice':
      $ret=array("male","female","child");
      break;
    case 'voice-family':
      $ret = array_merge($ret, get_property("generic-voice"));
      $ret = array_merge($ret, get_property("specific-voice"));
      break;
    case 'volume':
      $ret=array("XX","silent","x-soft","soft","medium","loud","x-loud");
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'white-space':
      $ret=array("normal","pre","nowrap");
      break;
    case 'widows':
      $ret=array("XX");
      break;
    case 'width':
      $ret=array("auto");
      $ret = array_merge($ret, get_property("length"));
      $ret = array_merge($ret, get_property("percentage"));
      break;
    case 'word-spacing':
      $ret=array("normal");
      $ret = array_merge($ret, get_property("length"));
      break;
    case 'z-index':
      $ret=array("auto","XX");
      break;
      
    }
  
  return $ret;
}

function view($type,$val,$nbrows)
{
  // recupere la property
  $val = base64_decode($val);
  $nval = "";

  switch($type)
    {
    case RULESET:
      $rex = "/^([^{]*)({[\n\r]*)(.*)$/s";
      break;
    default:
      $rex = "/^([^:]*)(:[\n\r]*)(.*)$/s";
      break;
    }

  if (preg_match($rex, $val, $m))
    {
      $rawtok = $m[1];
      $tok = trim($rawtok);
      $rawtok = $m[1].$m[2];
      $nval = $m[3];
      $vals = get_vals($type,$tok);
    }
  
  echo "<html>";
  echo "<head>
<style>
<!--
.main {background-color: #f5f5f5;}
#cr {cursor:pointer;font-family: courier;color: red; font-weight: bold;}
#cn {cursor:pointer;font-family: courier;color: black; font-weight: bold;}
#cg {cursor:pointer;font-family: courier;color: green; font-weight: normal;}
.sel { width:100%; font-weight: normal; font-size:12px; text-decoration: none;}
.ta{ width: 100%; margin: 0;}
.cont{ margin:0;padding:0;float:left; width: 100%; margin: 0;}
.cmenu{ }
.menu{ }
.poub{  }
-->
</style>
<script language=\"JavaScript\">
<!--
";

  if ($type==RULESET)
    echo "
function chval(nval)
{
  val=document.local.nval.value;
  idx=0; dum=\"\";
  c = val.charAt(idx);
  while (c==\" \"||c==\"\t\") 
   {dum=dum+c; idx++; c=val.charAt(idx);}
  val2 = dum + nval + \": ;\\n\" + val;
  document.local.nval.value = val2;
}
";
  else echo "
function chval(nval)
{
  val = document.local.nval.value;
  c = val.substring(0,1);
  if (c==\" \"||c==\"\t\") dum=\"\";
  else {dum=\" \";c=\"\";}
  val2 = c + nval + dum + val;
  document.local.nval.value = val2;
}
";

echo "
function terminer()
{ 
  tok = decode64(document.local.tok.value);
";
  if ($type==RULESET)
    echo "nval = tok + document.local.nval.value;";
  else
    echo "nval = tok + document.local.nval.value;";

  echo "
  window.opener.document.formulaire.nval.value=nval;
  window.close();
}

function poubelle()
{
  /* marche pas */
  if (window.getSelection) sel = window.getSelection();
  else if (document.getSelection) sel = document.getSelection();
  else if (document.selection) sel = document.selection.createRange().text;
  else return;

  val = document.local.nval.value;
  ln = sel.length;
  idx = val.indexOf(sel, 0);  
  nval = val.substr(0,idx)+val.substr(idx+val);
  document.local.nval.value = nval;
}";

echo base64code();

echo "
-->
</script>
</head>
<body class=\"main\">
";

  echo "<form action='#' method='POST' name='local'>\n";
  echo "<input type='hidden' value='".base64_encode($rawtok)."' name='tok'>\n";
  echo "<textarea class=\"ta\" rows=\"".$nbrows."\" ".
    " name=\"nval\">".$nval."</textarea>\n";
  echo "</form>\n";

  echo "<select name='item' size='3' Style='width:100%;'>\n";
  foreach($vals as $ref) 
  {
    echo "<option value='#' class='sel' OnDblClick='chval(\"".$ref."\")'>".$ref."</option>\n";
    //echo "<a href='#' onClick='chval(\"".$ref."\")'>".$ref."</a>&nbsp;\n\n";
  }
  echo "</select>\n";

  $ok = "<input ALT=\"ok\" title=\"ok\" type=\"image\" value=\"ok\" HSPACE=0 ".
    "border=0 src=\"./eledicss.php?image=ok\" name=\"ok\" onClick=\"terminer();return false;\">\n";
  $cancel = "<input ALT=\"cancel\" title=\"cancel\" type=\"image\" value=\"cancel\" HSPACE=0 ".
    "border=0 src=\"./eledicss.php?image=cancel\" name=\"cancel\" onClick=\"window.close();return false;\">\n";
  $poub = "<input ALT=\"poubelle\" title=\"poubelle\" type=\"image\" value=\"poubelle\" HSPACE=0 ".
    "border=0 src=\"./eledicss.php?image=poubelle\" name=\"poubelle\" onClick=\"poubelle();return false;\">\n";

  //echo "<p class='poub'>".$poub."</p>\n";
  echo "<p>".$ok.$cancel."</p>\n";

  echo "</body></html>\n";
  
  exit;
}

function display_page($page, $cd, $fcss, $xw, $yw, $nid, $watt)
{
  global $file;
  global $debut, $fin1, $fin2;

  $rcd = realpath($cd);

  echo "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<style>
<!--
.main {padding:5px;border: 1px solid; background-color: #f5f5f5;}
#cr {cursor:pointer; font-family: courier;color: red; font-weight: bold;}
#cn {cursor:pointer; font-family: courier;color: black; font-weight: bold;}
#cg {cursor:pointer; font-family: courier;color: green; font-weight: normal;}
a {text-decoration: none; border-width:0;}
img {  border: none;  vertical-align: middle;}

-->
</style>
<script language=\"JavaScript\">
<!--
";

if ($watt==false)
{
  echo "alert(\"Impossible d'enregistrer les modifications : le fichier est protégé en écriture. Vous devez changer les droits du fichier sur le serveur web.\");";
}

echo "
function confirmSubmit(text)
{
 var yes = confirm(text);
 if (yes) return true;
 else return false;
}

function rw(nodeid)
{
  if (window.pageXOffset)
    xw=window.pageXOffset;
  else
    xw=document.body.scrollLeft;

  if (window.pageYOffset)
    yw=window.pageYOffset;
  else
    yw=document.body.scrollTop;

  window.location = \"./eledicss.php?nid=\"+nodeid+\"&cd=".urlencode($cd)."&file=".urlencode($file)."&xw=\"+xw+\"&yw=\"+yw;
}

function rwpage()
{
  if (window.pageXOffset)
    xw=window.pageXOffset;
  else
    xw=document.body.scrollLeft;

  if (window.pageYOffset)
    yw=window.pageYOffset;
  else
    yw=document.body.scrollTop;

  window.location = \"./eledicss.php?nid=0&cd=".urlencode($cd)."&file=".urlencode($file)."&xw=\"+xw+\"&yw=\"+yw;
}

function getCoord(e) {

    var x=y=0;
    if (e != '') {
        x = e.screenX;
        y = e.screenY;
    }

    return ',screenX=' + x + ',screenY=' + y + ',left=' + x + ',top=' + y;
}
";

echo base64code();

echo "

-->
</script>
</head>
<body>
";

  $dirs = get_dirs($rcd);
  echo "<form method='POST' action='./eledicss.php'>";
  echo "<div class='main' onDblClick='rwpage();'>";
  echo "<a href='./eledicss.php?cd=.'><img src=\"./eledicss.php?image=dir\" /></a>&nbsp;";
  echo "<select name='cd' onchange='submit();' style='Width: 350px;'>\n";
  foreach($dirs as $dir)
    {
      $val = $cd."/".$dir;
      if ($dir==".")
        $val = $cd;
      else if ($dir=="..")
        {
          $val = dirname($cd);     
          if ($val == ".") $val = "..";
        }
      echo "<option value='".$val."'>".$val."</option>";
      //echo "<option value='".$val."'>".$dir."</option>";
    }
  echo "</select>\n";

  echo "&nbsp;&nbsp;<img src=\"./eledicss.php?image=file\" />&nbsp;";
  echo "<select name='file' onchange='submit();' style='Width: 250px;'>\n";
  $nb = 0;
  foreach($fcss as $fl)
    {
      $sl = "";
      if ($file == $fl)
	$sl = " selected ";
      echo "<option value='".$fl."' ".$sl.">".$fl."</option>";
      $nb ++;
    }
  echo "</select>\n";

  //echo "&nbsp;<input type='text' name='cd' value='".$cd."'>";
  echo "&nbsp;&nbsp;";
  //echo "<b>".$cd."</b>";
  $nb--;
  echo "<b>".$nb." fichiers CSS</b>";

  $tps1 = $fin1 - $debut;
  $tps2 = $fin2 - $fin1;

  echo "</div><br><div class='main'>\n";

  echo "</form><form method='POST' action='./eledicss.php' name='formulaire'>
<input type=\"hidden\" name=\"file\" value=\"".$file."\">
<input type=\"hidden\" name=\"cd\" value=\"".$cd."\">
<input type=\"hidden\" name=\"xw\" value=\"".$xw."\">
<input type=\"hidden\" name=\"yw\" value=\"".$yw."\">
<input type=\"hidden\" name=\"nid\" value=\"".$nid."\">
";

  echo $page;

  echo "</form>\n";

  echo "
<script language=\"JavaScript\">
<!--
  self.scrollTo('".$xw."', '".$yw."');
-->
</script>
  ";

  echo "</div></body></html>\n";
}


function base64code()
{
// AUTHOR: Adrian Bacon
// http://blog.quicksurf.com/index.php?p=78
return "
var keyStr = \"ABCDEFGHIJKLMNOPQRSTUVWXYZ\" + //all caps
\"abcdefghijklmnopqrstuvwxyz\" + //all lowercase
\"0123456789+/=\"; // all numbers plus +/=

//Heres the encode function
function encode64(inp)
{
var out = \"\"; //This is the output
var chr1, chr2, chr3 = \"\"; //These are the 3 bytes to be encoded
var enc1, enc2, enc3, enc4 = \"\"; //These are the 4 encoded bytes
var i = 0; //Position counter

do { //Set up the loop here
chr1 = inp.charCodeAt(i++); //Grab the first byte
chr2 = inp.charCodeAt(i++); //Grab the second byte
chr3 = inp.charCodeAt(i++); //Grab the third byte

//Here is the actual base64 encode part.
//There really is only one way to do it.
enc1 = chr1 >> 2;
enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
enc4 = chr3 & 63;

if (isNaN(chr2)) {
enc3 = enc4 = 64;
} else if (isNaN(chr3)) {
enc4 = 64;
}

//Lets spit out the 4 encoded bytes
out = out + keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) +
keyStr.charAt(enc4);

// OK, now clean out the variables used.
chr1 = chr2 = chr3 = \"\";
enc1 = enc2 = enc3 = enc4 = \"\";

} while (i < inp.length); //And finish off the loop

//Now return the encoded values.
return out;
}

//Heres the decode function
function decode64(inp)
{
var out = \"\"; //This is the output
var chr1, chr2, chr3 = \"\"; //These are the 3 decoded bytes
var enc1, enc2, enc3, enc4 = \"\"; //These are the 4 bytes to be decoded
var i = 0; //Position counter

// remove all characters that are not A-Z, a-z, 0-9, +, /, or =
//var base64test = \"/[^A-Za-z0-9+/=]/g\";

//if (base64test.exec(inp)) { //Do some error checking
//alert(\"There were invalid base64 characters in the input text.n\" +
//\"Valid base64 characters are A-Z, a-z, 0-9, ?+?, ?/?, and ?=?n\" +
//\"Expect errors in decoding.\");
//}
inp = inp.replace(\"/[^A-Za-z0-9+/=]/g\", \"\");

do { //Here?s the decode loop.

//Grab 4 bytes of encoded content.
enc1 = keyStr.indexOf(inp.charAt(i++));
enc2 = keyStr.indexOf(inp.charAt(i++));
enc3 = keyStr.indexOf(inp.charAt(i++));
enc4 = keyStr.indexOf(inp.charAt(i++));

//Heres the decode part. There?s really only one way to do it.
chr1 = (enc1 << 2) | (enc2 >> 4);
chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
chr3 = ((enc3 & 3) << 6) | enc4;

//Start to output decoded content
out = out + String.fromCharCode(chr1);

if (enc3 != 64) {
out = out + String.fromCharCode(chr2);
}
if (enc4 != 64) {
out = out + String.fromCharCode(chr3);
}

//now clean out the variables used
chr1 = chr2 = chr3 = \"\";
enc1 = enc2 = enc3 = enc4 = \"\";

} while (i < inp.length); //finish off the loop

//Now return the decoded values.
return out;
}
";

}

/*  Extracted from :
 *  Free download from http://php.spb.ru/remview/
 *  Please, report bugs...
 *  This programm for Unix/Windows system.
 *  (c) Dmitry Borodin, dima@php.spb.ru, http://php.spb.ru 
 */
function return_image($name)
{
  unset($img);

  $img=array(
'dir'=>
'R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAA'.
'AAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp'.
'/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs=',
'file'=>
'R0lGODlhEAAQAPUwAAICAhERDxoaGTQzMlpOPU9MRlhTTGNdU21kWHRqXGhmZHluYHpyZXp4c4h1W4Z6Z4+CbouEeI6NjJiXlKaek6ijnLOkjLaql62trbiuoLu0qry5tce1msG+utC+osTBvNrGp9jLtuPKpejTtMnIx9jOwNvUyNbW1uraw+7iz+bj3vHn1+rq6fPs4fDw7vf39wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEBADAALAAAAAAQABAAAAbmQBgM9qBgKJWJpKEAwGAwGAz2IL1crterIxkAYDAYDPYguU4n1ktFwgwAMBgM9iC5SCTSSSUhSYCKAQwGW5BYpBPp9NJMGgoBDAZLkFgk0un1cp02igAMBkt8XKQTiUTqbD4MAAwGQ3xYJBKJ9OkANaFGAAaDIT4sEmnT2WguoUcABoMdPqzPZrPRZC6jBwAGgx06rE1Ho7lcLqFHAAaDGTaqjSaTAV4uFtADAIPBDJuWqRQKgUAckQMAg8EKm9YqhbqMRCKRIwCDwQqNSCTyeDgeDgcBAIPBBoEAIAAEBAKAACAACAIAOw==',
'ok'=>
'R0lGODlhEAAOAPIHAAAAAABAAEAAAACAAADAAMD/wP///wAAACH5BAEBAAcALAAAAAAQAA4AAAOEaGZmhmZmZmhmZYZmZmZoZmaGRWZmaGZmhmZWNGhmZoZmZmZYNGGGZmZmaGZFgwFmNWhmZoZFE2BoRTSGZlY0GGIGgUM0Zlg0AYZmBjFINEWDIWZmaCYxhEQTYmhmZoYGMTQYYGaGZmZmCDEBhmZmZmhmZoACZmZoZmaGZmZmaGZmhmYJADs=',
'cancel'=>
'R0lGODlhFgAWAPIEAAAAAP8CAP99fYCAgAAAAAAAAAAAAAAAACH5BAEBAAQALAAAAAAWABYAAAP+SEREhEREREhERIRERERIRESERERESEREhEREREhERIRERERIRESERERESEREhEREREhERIRERERIRESERERESEREhEREREhERIRERERIRESERERESEREhEREREhERIRERERIRESERERESEREhEREREhERIRERERIRESERERESEREhEREREhERIBERERIRESEBDBESAQBg0REREhERIQAQwQYETCERERESEREgAEQIQgwRIRERERIRASBIQIzOEREhEREREhEEIIwM0RIRESERERECCECg0NEREhERIREBAE4EDCERERESEREhBAwQwgBQ4RERERIRBCAM0QECEMdRIRERERIADOEREQAOEREhEREBDhDRIREBENIRJQAOw==',
'view'=>
'R0lGODlhEAAQAKUAAP///tbi8miQ0HGX1X6Xz194vcTL5f///9bh7WeU1cfg+9Pq/1RtudHT5XeazovD+5PL/4TE/1ViqmWU006p/0Sk/xqR/wGG/xI1n1SCxw2J/wyI/wGE/zFHn4yauA9y5w+F/wlk3IF4nUBYoyx74jqb/yhz3P///////////////////////////////////////////////////////////////////////////////////////////////////ywAAAAAEAAQAAAGa0CAcEgsHopI4vHAbDqdw6f0GKUqPtjsQknNej/cxwdCLpM/ESFTbDZ/QurDm0KnVCoWyzs+r9/zewBMWBoaGxscHFghcIJyH4WHiYuNTBQfIJmalHEAmJmUjFVCJCQhWSaNnQAKJF4kCkJBADs=',
'poubelle'=>
'R0lGODlhDAAWAMYAAP///2NxX3qJdmx6aV5rW218aWx6aGZzY257apqtlYCPfHB8bXuIeH6Ne46dimFtXa/AqrTDr6y6qau5qK28qaOyn4mYhV9rXC00K3aEdKO0n6Gznpeok3+PfFRgUS41LBIVETU9My41LRwhHB8kHhUYFAYHBgEBAQMDAwwODC82Lj1GPFVhUiInIQcIBwgJCA0QDR0iHDlCNy42LICRfHqLdl5sW0lURkBKPkROQT1GOi00Ko2giI2gh3yOeGx8aGl4ZlZjU1BcTEVOQiw1Ko6giY2iiYSWgHKDbnB/bF5qWlFdTUZQQyw0Ko2giY2hiYWWgHODbnB/bV5rWlBdTScuJQAAAIyeh42hiCEnH4iahHCAbEZRQxoeGExWSombhXOEb3OCbmFuXlFeTj9IPQkKCBUXFEBJPkxYSUdSRThANhwhG////////////////////////////////////////////////////////////////////////////////yH+FUNyZWF0ZWQgd2l0aCBUaGUgR0lNUAAsAAAAAAwAFgAAB56AAIKDhIWGh4iJiouMjYcBAgMEBQYHgwgJCgsMDQ4OD4MQERITFBUWFxiDGRobHB0eHyAhIoMjJCUmJygpKiuDLC0pLi8wMTIzgzQ1Njc4ODk6O4M8PT4/QEFCQ0SDRUZHSElKS0xNg05PUFFSU1RMVVZWAFdYR1FJU+VZ8gBaWFCQbNHHpcs8AF6wfAETRswYMmUImTmDJo2aNYQCAQA7'
);

   header("Content-type: image/gif");
   header("Cache-control: public");
   // /*
   header("Expires: ".date("r",mktime(0,0,0,1,1,2037)));
   header("Cache-control: max-age=".(60*60*24*7));
   header("Last-Modified: ".date("r",filemtime(__FILE__)));
   // */
   echo base64_decode($img[$name]);

   break;
}


?>
