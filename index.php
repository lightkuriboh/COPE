<!DOCTYPE HTML>
<html>
	<title>
		Kuriboh Kute
	</title>
	<head>		
		<?php
			include("header.php");
		?>				
	</head>
	<body>		
		<div class = "session_classes">
			<?php
				include("session.php");
			?>
		</div>
		<div id = "main_block">
			<div class="container-fluid" style="height:60px;">

				<?php
					include("logo.php");
				?>		
			</div>
			<?php
				include ("Origin.php");
			?>			
			<div id = "main">
				<div id = "main_content">
					<section>						
						<div class = 'well'>
						<ul>
							<li>
								<b style = ""> <h3> Giới thiệu: </h3></b> <br>
								Trang web được làm ra với mục đích cung cấp môi trường làm và chấm bài phù hợp với học sinh chuyên Sư Phạm (Exclusive),
								được cập nhật, đổi mới liên tục bởi <<h4> COPE team </h4> và được tài trợ bởi: <br>
								<a target = "_blank" href = "https://www.facebook.com/chinhcsp">
									<ins> <b style = "font-size:120%;">Ching.MaMa Group</b></ins>.
								</a>
								<br> <!--<i style = "color:orange;"> Bài làm nộp lên được chấm bằng phần mềm 
								<a target = "_blank" href = "https://dsapblog.wordpress.com/">
								Themis
								</a>
								 (Thầy Lê Minh Hoàng & Đỗ Đức Đông). </i> -->
							</li>
							<li>
								<b style = ""> <h3>Có gì mới? </h3></b> <br>
								<ul>
									<li>
										Kho đề bài khổng lồ, dễ tìm bài mà không cần phải tải bài về như trước.
									</li>
									<li>
										Khả năng lọc bài theo loại kiến thức (tag).
									</li>
									<li>
										Liệt kê các lượt submit của tất cả người, dễ dàng trong việc xem lượt submit của từng bài và từng người
										(Tạo điều kiện thuận lợi để Ching.MaMa Group thu lợi nhuận từ những ai cẩu thả).
									</li>
									<li>
										Cập nhật liên tục thứ hạng của những người chăm chỉ nhất.
									</li>
									<li>
										Xem được bài nào đã AC, bài nào chưa AC, bài nào 0 điểm, bài nào chưa làm ngay trong danh sách bài,
										 không sợ nộp lại vô ích.
									</li>
									<li>
										Xem lại code của mình theo từng bài bất cứ lúc nào.
									</li>
									<li>
										Sort bài theo số lượng người làm được (click vào "ACs"), 
 có thể sort theo số lượng người làm được với một mục kiến thức (tags) nào đó (tìm kiếm trước rồi ấn vào "ACs" sau).
									</li>
								</ul>
							</li>
							<li>
								<b style = ""> <h3> Những gì sắp đến? </h3></b> <br>
								<ul>
									<li>
										Chức năng contest cho bạn cơ hội so tài với các đối thủ khác trong môi trường cạnh tranh.
									</li>
									<li>
										<ins style = "color:orange;font-size:110%;"> <i> Đặc biệt </i> </ins>: <br>
										<i style = "color:purple;font-size:150%;"> Sự cập bến của siêu phẩm: Tuyển đã tôi thế đấy!!! </i>
									</li>
								</ul>
							</li>
						</ul>
						</div>
					</section>
					<aside style = "text-align:center;">
						<div class = "panel panel-primary">
							<div class = "panel-heading">
								New Problems
							</div>
							<div class = "panel-body">
								<table class="table table-bordered">
									<?php
										include("classes/new_problems.php");
									?>
								</table>
							</div>
						</div>
					</aside>
				</div>
			</div>			
		</div>
	</body>
</html>
