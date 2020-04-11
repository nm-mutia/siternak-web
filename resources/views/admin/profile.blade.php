@extends('layouts.part')

@push('link')

@endpush

@section('title')
<h2>PROFIL - {{ Auth::user()->name }}</h2>
@endsection

@section('breadcrumb')
<li class="active"><i class="material-icons">person</i> Profil </li>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Detail Profil</h2>
            </div>
            <div class="body">
            	<div align="left">
				    <button type="button" name="edit_password" id="edit_password" class="btn btn-warning btn-sm">
						<i class="material-icons">edit</i><span class="icon-name">Ubah Password</span>
					</button>
				</div>
				<br>
				<div>
	                <table class="table">
	            		<tr>
	            			<td style="width: 30%;"><i class="material-icons">person</i><span class="icon-name">Nama</span></td>
	            			<td>{{ Auth::user()->name }}</td>
	            		</tr>
	            		<tr>
	            			<td style="width: 30%;"><i class="material-icons">person_outline</i><span class="icon-name">Username</span></td>
	            			<td>{{ Auth::user()->username }}</td>
	            		</tr>
	            		<tr>
	            			<td style="width: 30%;"><i class="material-icons">person_pin</i><span class="icon-name">Role</span></td>
	            			<td>{{ Auth::user()->role }}</td>
	            		</tr>
	            		<tr>
	            			<td style="width: 30%;"><i class="material-icons">email</i><span class="icon-name">Email</span></td>
	            			<td>{{ Auth::user()->email }}</td>
	            		</tr>
	            		<!-- <tr>
	            			<td><i class="material-icons">vpn_key</i><span class="icon-name">Password</span></td>
	            			<td>{{ Auth::user()->password }}</td>
	            		</tr> -->
	            	</table>
            	</div> 

            	<div align="center">
				    <button type="button" name="edit_profil" id="edit_profil" class="btn btn-info btn-sm">
						<i class="material-icons">edit</i><span class="icon-name">Ubah Data Profil</span>
					</button>
				</div>

            </div>
        </div>
    </div>
</div>

<!-- uabh profil modal -->
<div id="ubahProfilModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Ubah Data Profil</h4>
			</div>
			<div class="modal-body">
				<span id="form_result"></span>
				<form method="post" id="ubah_data_form">
					@csrf

					<div class="form-group">
						<label class="control-label">Nama</label>
						<div class="form-line col-md-8">
							<input type="text" name="name" id="name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Username</label>
						<div class="form-line col-md-8">
							<input type="text" name="username" id="username" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Email</label>
						<div class="form-line col-md-8">
							<input type="text" name="email" id="email" class="form-control">
						</div>
					</div>
					<br>
					<div class="form-group" align="center">
						<input type="hidden" name="action" id="action" value="Add">
						<input type="hidden" name="hidden_id" id="hidden_id">
						<input type="submit" name="action_button" id="action_button" class="btn btn-info" value="Ubah">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="ubahPassModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Ubah Password</h4>
			</div>
			<div class="modal-body">
				<span id="form_result_pass"></span>

				<form id="ubah_pass_form" method="POST" action="{{ route('admin.password.update') }}">
	                @csrf
	                
	                <div class="form-group">
	                    <label for="current_password" class="control-label">Password Saat Ini</label>
	                     <div class="input-group">
                            <div class="form-line">
                                <input id="current_password" type="password" class="form-control" name="current_password" required placeholder="Masukkan Password">
                                @if ($errors->has('current_password'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('password') }}</strong>
			                        </span>
			                    @endif
                            </div>
                            <span class="input-group-addon">
                                <span toggle="#password-field" id="password-field-1" class="toggle-password" style="cursor: pointer;"><i class="material-icons">visibility</i></span>
                            </span>
                        </div>
	                </div>
	 				
	                <div class="form-group">
	                    <label for="password" class="control-label">Password Baru</label>
	                     <div class="input-group">
                            <div class="form-line">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Masukkan minimal 6 karakter">
                                @if ($errors->has('password'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('password') }}</strong>
			                        </span>
			                    @endif
                            </div>
                            <span class="input-group-addon">
                                <span toggle="#password-field" id="password-field-2" class="toggle-password" style="cursor: pointer;"><i class="material-icons">visibility</i></span>
                            </span>
                        </div>
	                </div>
	 				
	                <div class="form-group">
	                    <label for="password-confirm" class="control-label">Konfirmasi Password Baru</label>
	                     <div class="input-group">
                            <div class="form-line">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Konfirm Password baru">
			                    @if ($errors->has('password_confirmation'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('password_confirmation') }}</strong>
			                        </span>
			                    @endif
                            </div>
                            <span class="input-group-addon">
                                <span toggle="#password-field" id="password-field-3" class="toggle-password" style="cursor: pointer;"><i class="material-icons">visibility</i></span>
                            </span>
                        </div>
	                </div>
	 				<br>
	                <div class="form-group">
	                    <div class="col-12 text-center">
	                        <button class="btn btn-primary" type="submit">Submit</button>
	                    </div>
	                </div>
	            </form>

			</div>
		</div>
	</div>
</div>

@endsection

@push('script')
<script src="{{ asset('/js/profile.js') }}"></script>
@endpush