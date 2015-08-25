<?php 
include("jpgraph-1.20.1/src/jpgraph.php"); 
include("jpgraph-1.20.1/src/jpgraph_pie.php"); 
include("jpgraph-1.20.1/src/jpgraph_pie3d.php");   
include("jpgraph-1.20.1/src/jpgraph_bar.php"); 


class graph_creator {
	
	var $height;		//graph height
	var $width;			//graph width
	var $title;			//graph title
	var $label;			//data labels
	var $data;			//the actuall values
	var $bgImage;		//the background image
	var $center_value;	//sets the center of the graph
	
	function graph_creator( $h, $w, $t, $label, $data, $center_value = 0.45 ) {
		//initialize class variables
		$this->height = $h;			//graph height
		$this->width = $w;			//graph width
		$this->title = $t;			//graph title
		$this->label = $label;		//label of data on the graph or the legend
		$this->data = $data;		//the data to be presented
		$this->bgImage = $bgImg;	//the background image
	}
	function create_pie_graph() {
		$graph = new PieGraph($this->width, $this->height,"auto");		//instantiate new PieGraph object
		$graph->SetShadow();											//displayed with shadow

		$graph->title->Set($this->title);								//setup graph title
		$graph->title->SetFont(FF_VERDANA,FS_BOLD,10); 			//set up font porperties
		$graph->title->SetColor("darkblue");

		$p1 = new PiePlot3D($this->data);								//define new 3D image for PieGraph
		$p1->ExplodeAll();											//explode each sector of the pie
		$p1->SetTheme("sand");						//set up the theme (Colors)
		$p1->SetCenter(0.45);						//display on center
		$p1->SetLegends($this->label);				//set up legend of the graph
		//$p1->SetLabel($this->label);				//set up the labels of each sector of the pie graph
		// Setup the slice values
		$p1->value->SetFont(FF_ARIAL,FS_BOLD,11);
		$p1->value->SetColor("navy");

		$graph->Add($p1);							//add 3D pie to PieGraph object
		$graph->Stroke();							//display grapg
	}
	
	//this function is used to create a bargraph
	function create_bar_graph() {	
	}
	
	//this code is for trouble shooting only
	//this function displays the values of the 
	//class variables
	function display() {
		echo '<br>'.$this->height;
		echo '<br>'.$this->width;
		echo '<br>'.$this->title;
		echo '<br>'.$this->label;
		echo '<br>'.$this->data;
		echo '<br>'.$this->bgImage;
	}
}
?>