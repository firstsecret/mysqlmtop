<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL 慢查询分析平台<small> </small></h2>
</div>

  

<table class="table  table-bordered table-condensed" style="font-size: 12px;" >
    
    <tr>
        <th style="width: 120px;">start_time</th>
        <td colspan="2"><?php echo $record['start_time']; ?></td>
        <th>user_host</th>
        <td colspan="3"><?php echo $record['user_host']; ?></td>
	</tr>
    <tr>
        <th>query_time</th>
        <td colspan="2"><?php echo $record['query_time']; ?></td>
        <th>lock_time</th>
        <td colspan="3"><?php echo $record['lock_time']; ?></td>
	</tr>
    <tr>
        <th>sql_text</th>
        <td colspan="6"><?php echo $record['sql_text']; ?></td>
	</tr>
    <tr>
        <th>rows_sent</th>
        <td colspan="2"><?php echo $record['rows_sent']; ?></td>
        <th>rows_examined</th>
        <td colspan="3"><?php echo $record['rows_examined']; ?></td>
	</tr>
    <tr>
        <th>db</th>
        <td colspan="2"><?php echo $record['db']; ?></td>
        <th>last_insert_id</th>
        <td colspan="3"><?php echo $record['last_insert_id']; ?></td>
    </tr>
    <tr>
        <th>insert_id</th>
        <td colspan="2"><?php echo $record['insert_id']; ?></td>
        <th>server_id</th>
        <td colspan="2"><?php echo $record['server_id']; ?></td>
        <th>thread_id</th>
        <td colspan="2"><?php echo $record['thread_id']; ?></td>
    </tr>
<!--    <tr>-->
<!--        <th rowspan="2">Query Time</th>-->
<!--        <th>Query_time_sum</th>-->
<!--        <th>Query_time_min</th>-->
<!--        <th>Query_time_max</th>-->
<!--        <th>Query_time_pct_95</th>-->
<!--        <th>Query_time_stddev</th>-->
<!--        <th>Query_time_median</th>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <td>--><?php //echo $record['Query_time_sum']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Query_time_min']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Query_time_max']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Query_time_pct_95']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Query_time_stddev']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Query_time_median']; ?><!--</td>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <th rowspan="2">Lock Time</th>-->
<!--        <th>Lock_time_sum</th>-->
<!--        <th>Lock_time_min</th>-->
<!--        <th>Lock_time_max</th>-->
<!--        <th>Lock_time_pct_95</th>-->
<!--        <th>Lock_time_stddev</th>-->
<!--        <th>Lock_time_median</th>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <td>--><?php //echo $record['Lock_time_sum']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Lock_time_min']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Lock_time_max']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Lock_time_pct_95']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Lock_time_stddev']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Lock_time_median']; ?><!--</td>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <th rowspan="2">Rows Sent</th>-->
<!--        <th>Rows_sent_sum</th>-->
<!--        <th>Rows_sent_min</th>-->
<!--        <th>Rows_sent_max</th>-->
<!--        <th>Rows_sent_pct_95</th>-->
<!--        <th>Rows_sent_stddev</th>-->
<!--        <th>Rows_sent_median</th>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <td>--><?php //echo $record['Rows_sent_sum']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_sent_min']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_sent_max']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_sent_pct_95']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_sent_stddev']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_sent_median']; ?><!--</td>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <th rowspan="2">Rows Examined</th>-->
<!--        <th>Rows_examined_sum</th>-->
<!--        <th>Rows_examined_min</th>-->
<!--        <th>Rows_examined_max</th>-->
<!--        <th>Rows_examined_pct_95</th>-->
<!--        <th>Rows_examined_stddev</th>-->
<!--        <th>Rows_examined_median</th>-->
<!--	</tr>-->
<!--    <tr>-->
<!--        <td>--><?php //echo $record['Rows_examined_sum']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_examined_min']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_examined_max']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_examined_pct_95']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_examined_stddev']; ?><!--</td>-->
<!--        <td>--><?php //echo $record['Rows_examined_median']; ?><!--</td>-->
<!--	</tr>-->
	 
</table>

