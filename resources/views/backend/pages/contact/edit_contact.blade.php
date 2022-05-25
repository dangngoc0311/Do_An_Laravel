@extends('backend.master')
@section('title','Trả lời contatc')
@section('main')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Icon/Text</strong> Groups
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('phan-hoi-contact.update', $contact->id) }}" method="post"
                                class="form-horizontal">
                                @csrf @method('PUT')
                                <input type="hidden" name='id' value="{{ $contact->id }}">
                                <div class="form-group"><label for="title" class=" form-control-label">Tên danh mục</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="title" name="name" value="{{ $contact->name }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="phone" class=" form-control-label">Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="phone" id="phone" name="phone" value="{{ $contact->phone }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="email" class=" form-control-label">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="email" id="email" name="email" value="{{ $contact->email }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="textarea-input" class="form-control-label">Nội dung</label>
                                    <textarea name="message" value="{{ $contact->message }}" id="textarea-input" rows="10"
                                        placeholder="Content..." class="form-control">{{ $contact->message }}</textarea>

                                </div>

                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong> &nbsp;</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('admin.reply.contact') }}" method="post" class="form-horizontal">
                                @csrf
                                <input type="hidden" name='id' value="{{ $contact->id }}">
                                <input type="hidden" name='name' value="{{ $contact->name }}">
                                <input type="hidden" name='content' value="{{ $contact->message }}">
                                <div class="form-group"><label for="mail_send" class=" form-control-label">Email người
                                        nhận</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="mail_send" name="mail_send" value="{{ $contact->email }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('mail_send')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group"><label for="subject" class=" form-control-label">Subject</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="subject" id="subject" name="subject" value="{{ old('subject') }}"
                                            class="form-control-success form-control">
                                    </div>
                                    @error('subject')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="textarea-input" class="form-control-label">Nội dung</label>
                                    <textarea name="message" value="{{ old('message') }}" id="textarea-input" rows="10"
                                        placeholder="Content..." class="form-control">{{ old('message') }}</textarea>
                                </div>
                                <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@stop
