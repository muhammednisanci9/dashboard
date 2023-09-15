	<header>
		<section class="bar">
			<div class="bar-container">
				<div class="bar-menu">
					<img src="img/icon/menu.png" onclick="sidebaropen()">
				</div>
				<div class="bar-children">
						<div class="bar-ara">
							<input type="" name="" placeholder="Ara" id="ara">
						</div>	
						<div class="bar-item">
							<ol>
								<li>
									<img src="img/icon/notification.png" id="notification">
								</li>
								<li id="profile-container">
									<img src="img/icon/notification.png" id="profile">
									<span id="profile-arrow"></span>
									<ul id="bar-profile-item">
										<a href="profile"><li>Profilim</li></a>
										<a href="cikis"><li>Çıkış</li></a>
									</ul>
								</li>
							</ol>
						</div>
				</div>
			</div>
		</section>
	</header>

	<?php include 'sidebar.php'; ?>