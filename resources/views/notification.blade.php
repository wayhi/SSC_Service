<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  </head>
<body>
Dear User,<br><br>

Please be aware of the following information:

<table>
	<thead>
		<tr>
	        
	        <th>活动<br>Activity</th>
	        <th>项目<br>Item</th>
	        <th>内容<br>Content</th>
	       
	    </tr>
	</thead>    
    <tbody>
    	
    	@for($i=0;$i<count($items);$i++) 
    		<tr>
    			<td>{{$type}}</td>
    			<td>{{$items[$i]}}</td>
    			<td>{{$times[$i].''.$events[$i]}}</td>

    		</tr>
    		
    	@endfor

    </tbody>        
    
</table>
<br><br>
Best Regards,<br>
DaBaoJian Service Team 

<p style="font-weight:100;color:#777;font-size:12px;">PS: please do not reply this email.<br>请不要回复此邮件。</p>
</body>
</html>