#!/usr/bin/env python
#-*-coding:utf-8-*-

import MySQLdb
import string
import sys 
reload(sys) 
sys.setdefaultencoding('utf8')
import ConfigParser
import smtplib
from email.mime.text import MIMEText
from email.message import Message
from email.header import Header
import urllib3


def get_config(group,config_name):
    config = ConfigParser.ConfigParser()
    config.readfp(open('./etc/config.ini','rw'))
    config_value=config.get(group,config_name).strip(' ').strip('\'').strip('\"')
    return config_value


host = get_config('monitor_server','host')
port = get_config('monitor_server','port')
user = get_config('monitor_server','user')
passwd = get_config('monitor_server','passwd')
dbname = get_config('monitor_server','dbname')


def check_table_exist(table_name):
    #SELECT table_name FROM information_schema.TABLES WHERE table_name ='mysql_slow_query_review_1';
    conn=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=5,charset='utf8')
    conn.select_db('information_schema')
    cursor = conn.cursor()
    sql = "select table_name FROM information_schema.TABLES WHERE table_name = '%s' " % table_name
    exist = cursor.execute(sql)
    return exist
    cursor.close()
    conn.close()

def create_slow_table_by_name(table_name):
    conn=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=5,charset='utf8')
    conn.select_db('mysqlmtop')
    sql = "create table %s (" \
    "id int(12) unsigned NOT NULL AUTO_INCREMENT," \
    "start_time timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)," \
    "user_host mediumtext NOT NULL, " \
    "query_time time(6) NOT NULL, " \
    "lock_time time(6) NOT NULL, " \
    "rows_sent int(11) NOT NULL DEFAULT 0, " \
    "rows_examined int(11) NOT NULL DEFAULT 0, " \
    "db varchar(512) NOT NULL DEFAULT '', " \
    "last_insert_id int(11) NOT NULL DEFAULT 0, " \
    "insert_id int(11) NOT NULL DEFAULT 0, " \
    "server_id int(10) unsigned NOT NULL DEFAULT 0, " \
    "sql_text mediumblob NOT NULL, " \
    "thread_id bigint(21) unsigned NOT NULL DEFAULT 0, " \
    "PRIMARY KEY (`id`)" \
    ") ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;" % table_name
    cursor = conn.cursor()
    try:
        res = cursor.execute(sql)
        return res
    except MySQLdb.Error,e:
        pass
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])
    cursor.close()
    conn.close()

def mysql_exec(sql,param):
    conn=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=5,charset='utf8')
    conn.select_db(dbname)
    cursor = conn.cursor()
    if param <> '':
        cursor.execute(sql,param)
    else:
        cursor.execute(sql)
    conn.commit()
    cursor.close()
    conn.close()

def mysql_query(sql):
    conn=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=5,charset='utf8')
    conn.select_db(dbname)
    cursor = conn.cursor()
    count=cursor.execute(sql)
    if count == 0 :
        result=0
    else:
        result=cursor.fetchall()
    return result
    cursor.close()
    conn.close()

def get_option(key):
    conn=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=5,charset='utf8')
    conn.select_db(dbname)
    cursor = conn.cursor()
    sql="select value from options where name=+'"+key+"'"
    count=cursor.execute(sql)
    if count == 0 :
        result=0
    else:
        result=cursor.fetchone()
    return result[0]
    cursor.close()
    conn.close()


mail_host = get_config('mail_server','mail_host')
mail_user = get_config('mail_server','mail_user')
mail_pass = get_config('mail_server','mail_pass')
mail_postfix = get_config('mail_server','mail_postfix')

def send_mail(to_list,sub,content):
    '''
    to_list:发给谁
    sub:主题
    content:内容
    send_mail("aaa@126.com","sub","content")
    '''
    me=mail_user
    #me=mail_user+"<</span>"+mail_user+"@"+mail_postfix+">"
    msg = MIMEText(content, _subtype='html', _charset='utf8')
    msg['Subject'] = Header(sub,'utf8')
    msg['From'] = Header(me,'utf8')
    msg['To'] = ";".join(to_list)
    try:
        s = smtplib.SMTP()
        s.connect(mail_host)
        s.login(mail_user,mail_pass)
        s.sendmail(me,to_list, msg.as_string())
        s.close()
        return True
    except Exception, e:
        print str(e)
        return False


def send_message(to_list = None,sub = '',content = ''):
    '''
        you need custom youself
        company api 
    '''
    print(to_list)
    if to_list.isspace():
        return 500

    http = urllib3.PoolManager()

    r = http.request('GET', 'http://mapi.tiantianremai.cn/sms/text',fields={'phone': to_list,'type':3,'code':3})
    return r.status













