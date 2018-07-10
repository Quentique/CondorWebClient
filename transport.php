<!-- <iframe src="https://www.optymo.fr/infos_trafic/" style="width:100%; height:500px;" frameborder="0"></iframe>
<iframe src="https://www.sncf.com/fr/gares/belfort/OCE87184002/" style="width: 100%; height: 500px;" frameborder="0"></iframe> -->
<div class="grid-2-small-1-tiny-1 has-gutter-xl center" id="transport" >
	<a class="button1" target="_blank" rel="noopener noreferrer" href="https://www.optymo.fr/infos_trafic/" class="btn--primary"><div class="c"><img src="bus.png" class="center" alt="Optymo"/><h2>Optymo</h2><h3>Infos trafic</h3></div></a>
	<a class="button1" target="_blank" rel="noopener noreferrer" href="https://www.sncf.com/fr/gares/belfort/OCE87184002/" class="btn" alt="SNCF"><div class="c"><img src="train.png" class="center"/><h2>SNCF</h2><h3>Gare de Belfort Ville</h3></div></a>
</div>
<style>
.button1 {
	padding: 5% 20%;
	background-color: #bdbdbd;
	border: 1px solid #bdbdbd;
	border-radius: 7px;
	box-shadow: 0.25rem 0.25rem 2px #757575;
	transition-duration: 0.3s;
	-webkit-transition-duration: 0.3s;
	text-align: center;
	display: block;
}


.button1:hover {
	background-color: #757575;
	border-color: #757575;
}
#transport {
	padding: 0 10%;
	margin-bottom: 2%;
}
#transport h2, #transport h3 {
	text-decoration: none;
}
#transport h3 {
	font-style: italic;
}
@media screen and (min-width: 768px) {
	
.button1:before {
    content: ' ';
    display: inline-block;
    vertical-align: middle; 
    height: 100%;
}

.c {
	width: 30rem;
	display: inline-block;
	vertical-align: middle;
}
}
@media screen and (max-width: 479px)  {
	.button1 {
		padding: 20% 20%;
		margin: 9% 0%;
	}
}
</style>