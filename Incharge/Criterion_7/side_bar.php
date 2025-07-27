
<style>
	.scrollable {
    overflow-y: scroll; /* Enable vertical scrollbar */
    height: 200px; /* Set a fixed height for the container */
  }

  /* Optional: Customize scrollbar appearance */
  .scrollable::-webkit-scrollbar {
    width: 12px; /* Width of the scrollbar */
  }

  .scrollable::-webkit-scrollbar-thumb {
    background-color: #888; /* Color of the thumb */
    border-radius: 6px; /* Radius of the thumb */
  }

  .scrollable::-webkit-scrollbar-track {
    background-color: #f1f1f1;
	border-radius: 6px; /* Color of the track */
  }
</style>

<ul class="nav nav-pills flex-column mb-auto" id="menu-list">

	<li class="nav-item">
	    <a href="dashboard.php" class="nav-link" id="list-hover">
	       	<i class="fa-solid fa-gauge fa-lg"></i>&nbsp;&nbsp;Dashboard
	    </a>
	</li>

	<li class="nav-item">
	     <a class="nav-link" id="list-hover"><i class="fa-solid fa-person-half-dress fa-lg"></i>&nbsp;&nbsp;Criteria 7.1</a>
	    <div class="submenu">
	        <ul class="nav-item scrollable" >
	            <li><a href="cri_7.1.1_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.1.1</a></li>
	            <li><a href="cri_7.1.2_option.php" class="nav-link" id="list-hover">Criteria 7.1.2</a></li>
	            <li><a href="cri_7.1.3_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.1.3</a></li>
	            <li><a href="cri_7.1.4_option.php" class="nav-link" id="list-hover">Criteria 7.1.4</a></li>
				<li><a href="cri_7.1.5_option.php" class="nav-link" id="list-hover">Criteria 7.1.5</a></li>
				<li><a href="cri_7.1.6_option.php" class="nav-link" id="list-hover">Criteria 7.1.6</a></li>
				<li><a href="cri_7.1.7_option.php" class="nav-link" id="list-hover">Criteria 7.1.7</a></li>
				<li><a href="cri_7.1.8_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.1.8</a></li>
				<li><a href="cri_7.1.9_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.1.9</a></li>
				<li><a href="cri_7.1.10_option.php" class="nav-link" id="list-hover">Criteria 7.1.10</a></li>
				<li><a href="cri_7.1.11_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.1.11</a></li>




	        </ul>
	     </div>
	</li>

	<li class="nav-item">
	     <a class="nav-link" id="list-hover"><i class="fa-solid fa-wifi fa-lg"></i>&nbsp;&nbsp;Criteria 7.2</a>
	    <div class="submenu">
	        <ul class="nav-item">
	            <li><a href="cri_7.2.1_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.2.1</a></li>
			</ul>
	     </div>
	</li>

	<li class="nav-item">
	     <a class="nav-link" id="list-hover"><i class="fa-solid fa-wifi fa-lg"></i>&nbsp;&nbsp;Criteria 7.3</a>
	    <div class="submenu">
	        <ul class="nav-item">
	            <li><a href="cri_7.3.1_doc_upload.php" class="nav-link" id="list-hover">Criteria 7.3.1</a></li>
			</ul>
	     </div>
	</li>
</ul>



