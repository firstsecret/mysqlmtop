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
    </tr>

    <tr>
        <th>thread_id</th>
        <td colspan="6"><?php echo $record['thread_id']; ?></td>
    </tr>

<!--    explain start -->
    <tr>
        <th>explain_id</th>
        <td colspan="2"><?php echo $explain_res['id'] ?? NULL; ?></td>
        <th>select_type</th>
        <td colspan="3"><?php echo $explain_res['select_type'] ?? NULL; ?></td>
    </tr>

    <tr>
        <th>table</th>
        <td colspan="2"><?php echo $explain_res['table'] ?? NULL; ?></td>
        <th>partitions</th>
        <td colspan="3"><?php echo $explain_res['select_type'] ?? NULL; ?></td>
    </tr>

    <tr>
        <th>type</th>
        <td colspan="2"><?php echo $explain_res['type'] ?? NULL; ?></td>
        <th>possible_keys</th>
        <td colspan="3"><?php echo $explain_res['possible_keys'] ?? NULL; ?></td>
    </tr>

    <tr>
        <th>key</th>
        <td colspan="2"><?php echo $explain_res['key'] ?? NULL; ?></td>
        <th>key_len</th>
        <td colspan="3"><?php echo $explain_res['key_len'] ?? NULL; ?></td>
    </tr>

    <tr>
        <th>ref</th>
        <td colspan="2"><?php echo $explain_res['ref'] ?? NULL; ?></td>
        <th>rows</th>
        <td colspan="3"><?php echo $explain_res['rows'] ?? NULL; ?></td>
    </tr>

    <tr>
        <th>filtered</th>
        <td colspan="2"><?php echo $explain_res['filtered'] ?? NULL; ?></td>
        <th>Extra</th>
        <td colspan="3"><?php echo $explain_res['Extra'] ?? NULL; ?></td>
    </tr>
<!--    explain end-->

</table>

