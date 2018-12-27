#!/usr/bin/env python
#coding:utf-8
import os
import sys
import string
import time
import datetime
import MySQLdb
import global_functions as func
from multiprocessing import Process;


def check_mysql_slow_query(host,port,user,passwd,server_id,application_id):
	try:
		connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
		cur=connect.cursor()
		connect.select_db('mysqlmtop')

		sql = "select * from mysqlmtop.mysql_status where server_id = %d" % server_id
		cur.execute(sql)
		host_status_data = cur.fetchone()
		slave_server_id = host_status_data[len(host_status_data) - 1]

		# mysqlmtop slow log start
		# SELECT table_name FROM information_schema.TABLES WHERE table_name ='mysql_slow_query_review_1';
		table_name  = "mysql_slow_query_review_%d" % server_id
		is_exist_table = func.check_table_exist(table_name)
		# print(is_exist_table)

		if is_exist_table == 0:
			# craete table
			func.create_slow_table_by_name(table_name)

		# sure select where
		get_slow_sql = "select * from mysqlmtop.mysql_slow_query_review_%d order by start_time desc limit 1" % server_id

		cur.execute(get_slow_sql)
		mysqlmtop_slow_query = cur.fetchone()
		# mysqlmtop slow log end

		where_log = 'server_id = %d' % slave_server_id
		if mysqlmtop_slow_query:
			where_log = "server_id = %d and `start_time` > '%s'" % (slave_server_id,mysqlmtop_slow_query[1])

		msql = "select * from mysql.slow_log where %s order by start_time desc " % where_log
		cur.execute(msql)
		one_slow_query = cur.fetchone()
		#print(one_slow_query)
		while one_slow_query:
			# insert db 
			# insert_sql = "insert into mysqlmtop.mysql_slow_query_review_%d values('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');" % (int(server_id), 
			# 	one_slow_query[0], 
			# 	one_slow_query[1],
			# 	one_slow_query[2],
			# 	one_slow_query[3],
			# 	one_slow_query[4],
			# 	one_slow_query[5],
			# 	one_slow_query[6],
			# 	one_slow_query[7],
			# 	one_slow_query[8],
			# 	one_slow_query[9],
			# 	cur2.escape_string(one_slow_query[10]),
			# 	one_slow_query[11])
			# print(insert_sql)
			# cur2.execute(insert_sql)
			insert_sql = "insert into mysqlmtop.mysql_slow_query_review_%s " \
			"(`start_time`,`user_host`,`query_time`,`lock_time`,`rows_sent`,`rows_examined`,`db`,`last_insert_id`,`insert_id`,`server_id`,`sql_text`,`thread_id`) " \
			"values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s);"
			param = (int(server_id), 
				one_slow_query[0], 
				one_slow_query[1],
				one_slow_query[2],
				one_slow_query[3],
				one_slow_query[4],
				one_slow_query[5],
				one_slow_query[6],
				one_slow_query[7],
				one_slow_query[8],
				one_slow_query[9],
				one_slow_query[10],
				one_slow_query[11])
			func.mysql_exec(insert_sql, param)
			one_slow_query = cur.fetchone()

	except MySQLdb.Error,e:
		print(e)
		pass

def main():

    # func.mysql_exec("insert into mysql_status_history(server_id,application_id,connect,uptime,version,connections,active,create_time,YmdHi) select server_id,application_id,connect,uptime,version,connections,active,create_time, LEFT(REPLACE(REPLACE(REPLACE(create_time,'-',''),' ',''),':',''),12) from mysql_status;",'')
    # func.mysql_exec("delete from  mysql_status",'')
    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port,application_id,status from servers where is_delete=0;")
    if servers:
         print("%s: check_mysql_status controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
         plist = []
         for row in servers:
             server_id=row[0]
             host=row[1]
             port=row[2]
             application_id=row[3]
             status=row[4]
             if status <> 0:
				p = Process(target = check_mysql_slow_query, args = (host,port,user,passwd,server_id,application_id))
				plist.append(p)
				p.start()

         for p in plist:
             p.join()
         print("%s: check_mysql_status controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))


if __name__=='__main__':
    main()	
