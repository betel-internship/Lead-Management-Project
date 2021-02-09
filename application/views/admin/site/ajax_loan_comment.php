<?php if(count($data)>=1){ ?>
<div class="card-body panel-default widget">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    Recent Comments</h3>
                <!--<span class="label label-info">78</span>-->
            </div>
            <div class="panel-body">
                <ul class="list-group">
                  <?php foreach($data as $row){ ?>  
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="#">At that time status was: <b><?php echo $row->status; ?></b></a>
                                    <div class="mic-info">
                                        By: <a href="#"><?php echo $row->username; ?></a> on <?php echo date('d M Y h:i A', strtotime($row->created_date)); ?>
                                    </div>
                                </div>
                                <div class="comment-text">
                                   <?php echo $row->comment; ?>
                                </div>
                               
                            </div>
                        </div>
                    </li>
                  <?php } ?>
                </ul>
            </div>
        </div>
<?php } ?>