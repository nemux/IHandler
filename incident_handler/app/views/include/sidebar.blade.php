<div id="sidebar" class="sidebar">
<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;"><img src="/assets/img/handler.png" alt="" /></a>
						</div>
						<div class="info">
							Incident Handler
						</div>
            {{ Auth::user()->username." "}}
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Menú</li>
					<li class="has-sub ">
						<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-bookmark"></i>
								<span>Incidentes</span>

						</a>
						<ul class="sub-menu">
								<li class=""><a href="/incident/create">Crear</a></li>
								<li><a href="/incident/">Ver</a></li>
						</ul>
					</li>
          @if (Auth::user()->type->name == 'admin')
					<li class="has-sub ">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-user"></i>
						    <span>Incident Handler</span>
					    </a>
						<ul class="sub-menu">
						    <li><a href="/handler/create">Crear</a></li>
						    <li><a href="/handler/">Ver</a></li>style="display:none"
						</ul>
					</li>

          <li class="has-sub ">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-circle-o-notch"></i>
						    <span>OTRS</span>
					    </a>
						<ul class="sub-menu">
						    <li><a href="/otrs/import">Importar Informaci&oacute;n</a></li>
						</ul>
					</li>


					<li class="has-sub ">
						<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-eye"></i>
								<span>Sensores</span>
							</a>
						<ul class="sub-menu">
								<li><a href="/sensor/create">Crear</a></li>
								<li><a href="/sensor/">Ver</a></li>
						</ul>
					</li>

					<li class="has-sub ">
						<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-suitcase"></i>
								<span>Clientes</span>
							</a>

						<ul class="sub-menu">
								<li><a href="/customer/">Ver</a></li>
						</ul>
					</li>

            <li class="has-sub ">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-crosshairs "></i>
						    <span>Attacks</span>
					    </a>
						<ul class="sub-menu">
                <li><a href="/attack/create">Crear ataque</a></li>
						    <li><a href="/attack">Ver ataques</a></li>
						</ul>
					</li>

					@endif

					<li class="has-sub ">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-bar-chart-o"></i>
								<span>Estadísticas</span>
							</a>

						<ul class="sub-menu">
								<li><a href="/stats/incident">De incidentes</a></li>
								<li><a href="/stats/ip">De direcciones IP</a></li>
								<li><a href="/stats/handler">Incidentes por Handler</a></li>
								<li><a href="/stats/category">Por Categorías</a></li>
								<li><a href="/stats/attack">Por Ataques</a></li>
						</ul>
					</li>

			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
<div class="sidebar-bg"></div>
