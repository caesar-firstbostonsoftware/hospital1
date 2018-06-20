<?php $version = $this->db->get_where('settings', array('type' => 'version'))->row()->description;?>
<!-- Footer -->
<footer class="main">
	&copy; 2017 <strong>ACE Medical Center</strong>
    <strong class="pull-right"> VERSION <?php echo $version;?></strong>
    Developed by
	<a href="http://creativeitem.com"
    	target="_blank">FirstBostonSoftware</a>
</footer>
