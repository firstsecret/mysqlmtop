#!/usr/bin/env python
# -*- coding: utf8 -*-
from datetime import *
import global_functions  as func



phone = func.get_option('message_to_list')

values={}
values['phone'] = phone
values['type'] = 7
values['signname'] = '小店监控'
values['server'] = '10.18.1.1'
values['errmsg'] = '测试报警功能'

result = func.send_message(values)
print "发送结果:"
print result
print type(result)

