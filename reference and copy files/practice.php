<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		
	<style>
		body,html{
			height: 100%;
			margin: 0;
			background: #7F7FD5;
	    background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
	    background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
		}
		.container{
			align-content: center;
		}
		.chat{
			margin-top: auto;
			margin-bottom: auto;
			margin-right: 900px;
		}
		.card{
			height: 500px;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;
		}
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.contacts{
			list-style: none;
			padding: 0;
		}
		.contacts li{
			width: 100% !important;
			padding: 5px 10px;
			margin-bottom: 15px !important;
		}
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
		
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.user_info p{
	font-size: 10px;
	color: rgba(255,255,255,0.6);
	}
	.user_info:hover {
    cursor: pointer;
	}
	@media(max-width: 576px){
	.contacts_card{
		margin-bottom: 15px !important;
	}
	}

	</style>
</head>

<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
			 <div class="col-md-4 col-xl-3 chat">
			 	<div class="card mb-sm-3 mb-md-0 contacts_card"> 
				<div class="card-body contacts_body">
						<ui class="contacts">
						<li class="active">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="http://www.clker.com/cliparts/4/7/6/2/1370391492782346139business_user-1.png" class="rounded-circle user_img">
									<!-- <span class="online_icon"></span> -->
								</div>
								<div class="user_info">
									<span>Name</span>
									<p>Status</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://microhealth.com/assets/images/illustrations/personal-user-illustration-@2x.png" class="rounded-circle user_img">
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Name 2</span>
									<p>Status</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="http://indiads.co.in/ulog.png" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Name 2</span>
									<p>Status</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPwk9Kq2KdJCkGyiBkZa1zYLFU0gno05HematPvb3U-Q7e0ztDKw" class="rounded-circle user_img">
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Name 2</span>
									<p>Status</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.thenounproject.com/png/17239-200.png" class="rounded-circle user_img">
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Name 2</span>
									<p>Status</p>
								</div>
							</div>
						</li>
						</ui>
					</div>
				</div>
				</div>
				</div>
			</div>


			<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			
	</body>
</html>