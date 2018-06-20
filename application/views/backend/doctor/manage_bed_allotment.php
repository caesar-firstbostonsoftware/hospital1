<style type="text/css">
    div.card {
    width: 250px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    text-align: center;
}

@-webkit-keyframes swing
{
    15%
    {
        -webkit-transform: translateX(5px);
        transform: translateX(5px);
    }
    30%
    {
        -webkit-transform: translateX(-5px);
       transform: translateX(-5px);
    } 
    50%
    {
        -webkit-transform: translateX(3px);
        transform: translateX(3px);
    }
    65%
    {
        -webkit-transform: translateX(-3px);
        transform: translateX(-3px);
    }
    80%
    {
        -webkit-transform: translateX(2px);
        transform: translateX(2px);
    }
    100%
    {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
}
@keyframes swing
{
    15%
    {
        -webkit-transform: translateX(5px);
        transform: translateX(5px);
    }
    30%
    {
        -webkit-transform: translateX(-5px);
        transform: translateX(-5px);
    }
    50%
    {
        -webkit-transform: translateX(3px);
        transform: translateX(3px);
    }
    65%
    {
        -webkit-transform: translateX(-3px);
        transform: translateX(-3px);
    }
    80%
    {
        -webkit-transform: translateX(2px);
        transform: translateX(2px);
    }
    100%
    {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
}


.swing:hover
{
        -webkit-animation: swing 1s ease;
        animation: swing 1s ease;
        -webkit-animation-iteration-count: 1;
        animation-iteration-count: 1;
}
</style>

<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_bed_allotment');?>');" 
    class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_bed_allotment'); ?>
</button>
<div style="clear:both;"></div>
<br>
<?php
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 6;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
?>

<div class="container-fluid">  

<?php
foreach ($bed_floor as $row1){
    $rowCount = 0;
?>
<div class="row">  
<div class="well well-sm"><b>Floor <?php echo $row1['floor'] ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-bed" style="color:red"></span> <font color="red">Occupied</font> &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-bed" style="color:green"></span> <font color="green">Vacant</font></div>

<?php
foreach ($bed_vis as $row){    
    if($row['floor'] == $row1['floor']){
?> 
        <a href="#"><div class="swing col-md-<?php echo $bootstrapColWidth; ?>" onclick="showAjaxModal('<?php echo site_url('modal/popup/add_bed_allotment');?>');">
            <div class="thumbnail card" style="width: 150px; height: 10  0px;">
                <div><b>Type: </b><?php echo ucwords($row['type']) ?></div>
                <div><b>Room: </b><?php echo $row['room'] ?><br><br></div>
              <div>  <?php 
$x = 1; 

while($x <= $row['bed_number']) {
    if ($x <= $row['status']){
    ?>
    <span class="glyphicon glyphicon-bed" style="color:red"></span>
    <?php
}
else
{
    ?>
<span class="glyphicon glyphicon-bed" style="color:green"></span>
    <?php
}
    $x++;
} 
?></div>
            </div>
        </div></a>
<?php
} 
    $rowCount++;
    if($rowCount % $numOfCols < 0) echo '</div><div class="row">';
}
?>
</div>
<?php
}
?>

</div>




<br>


<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('floor');?></th>
            <th><?php echo get_phrase('room_no.');?></th>
            <th><?php echo get_phrase('beds');?></th>
            <th><?php echo get_phrase('bed_type');?></th>
            <th><?php echo get_phrase('patient');?></th>
            <th><?php echo get_phrase('allotment_time');?></th>
            <th><?php echo get_phrase('discharge_time');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($bed_allotment_info as $row) { ?>   
            <tr>
                <td>
                    <?php $bed_number = $this->db->get_where('bed' , array('bed_id' => $row['bed_id'] ))->row()->floor;
                        echo $bed_number;?>
                </td>
                <td>
                    <?php $bed_number = $this->db->get_where('bed' , array('bed_id' => $row['bed_id'] ))->row()->room;
                        echo $bed_number;?>
                </td>                
                <td>
                    <?php $bed_number = $this->db->get_where('bed' , array('bed_id' => $row['bed_id'] ))->row()->bed_number;
                        echo $bed_number;?>
                </td>
                <td>
                    <?php $type = $this->db->get_where('bed' , array('bed_id' => $row['bed_id'] ))->row()->type;
                        echo $type;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td><?php echo date("m/d/Y", $row['allotment_timestamp']); ?></td>
                <td><?php echo date("m/d/Y", $row['discharge_timestamp']); ?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_bed_allotment/'.$row['bed_allotment_id']);?>');" 
                        class="btn btn-default btn-sm">
                            <i class="fa fa-pencil"></i>&nbsp;
                            <?php echo get_phrase('edit');?>
                    </a>
                    <a onclick="confirm_modal('<?php echo site_url('doctor/bed_allotment/delete/'.$row['bed_allotment_id']); ?>')"
                        class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i>&nbsp;
                        <?php echo get_phrase('delete');?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 