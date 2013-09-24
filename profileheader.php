<fieldset >
					<legend style="color:#37b2d1">ผู้ใช้งานในขณะนี้</legend>
					<div >
						<img alt="user" height="12" src="img/mono-icons/user.png" width="12"> <?php printf("<b>%s %s</b>",$personal[0]['firstName'],$personal[0]['lastName']);?> 
						&nbsp; | &nbsp;<a href="profile.php">ปรับปรุงข้อมูลผู้ใช้</a> &nbsp;| &nbsp;<a href="logout.php">ออกจากระบบ</a> </div>
					<div >
						<?php 
						
						?>สิทธิ์ :<?php echo $personal[0]['usertype']?><b></b>
					</div>
					</fieldset>
