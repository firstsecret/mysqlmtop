#!/usr/bin/env python
# -*- coding: utf8 -*-
from datetime import *
import global_functions  as func


message_to_list = func.get_option('message_to_list')
messageto_list=message_to_list.split(';')


result = func.send_mail(messageto_list," I hope you can learn","Beautiful Day")
print result
if result:
    send_message_status = "success"
else:
    send_message_status = "fail"
print "send_message_status:"+send_message_status
