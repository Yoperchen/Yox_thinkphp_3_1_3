<?php
//顾客来电记录
//{:W('ListIncomingCallLog',array('template'=>'ListIncomingCallLog','store_id'=>1))}
class ListIncomingCallLogWidget extends Widget{  
    public function render($data){ 
    	$data['application'] = isset($data['application'])?$data['application']:'Common';
    	$Template = '';//模版
    	$Template = isset($data['template'])?$data['template']:'ListIncomingCallLog';
    	
    	$IncomingCall  =   M('Incoming_call_log');
    	
    	$conditions = array();;//条件
    	if(!empty($data['store_id'])){//商家
    		$conditions['store_id']=array('eq',$data['store_id']);
    	}
    	if(!empty($data['user_id'])){//用户ID
    		$conditions['user_id']=array('eq',$data['user_id']);
    	}
    	if(!empty($data['tel'])){//电话
			$conditions['tel']=array('eq',$data['tel']);
    	}
    	if(!empty($data['startTime'])){//时间范围
    		$conditions['addTime']=array('between',array($data['startTime'],$data['endTime']));
    	}
    	$data['call_list'] = $IncomingCall->where($conditions)->order('id')->limit(0,15)->select();
        $content = $this->renderFile($Template,$data);
     	if($data['format_type']=='json')
		{
			return json_encode(array('status'=>1,'data'=>$content));
		}
		elseif($data['format_type']=='xml')
		{
			
		}
		else
		{
	        return $content;  
		}
    } 
 }