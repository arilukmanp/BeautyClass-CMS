@extends('layouts.master')

@section('title', 'Add Speaker')

@section('content')
<div class="block-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-header bttl">
                    <h3>Add Speakers</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal edt" action="/speakers/store" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Fullname</label>
                            <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userfile">Photo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly>
                                <label class="input-group-btn">
                                    <span class="btn btn-danger">
                                        <span class="image-preview-input-title">Select Photo</span>
                                        <input type="file" accept="image/png, image/jpeg, image/jpg" id="userfile" name="userfile" style="display: none;" required>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="summernote_form" name="description"></textarea>
                            {{-- <label class="text-danger">Use <u><i>Shift+Enter</i></u> for enter</label> --}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-btn">
                            <a href="/speakers" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp; Cancel</a>
                            <button type="submit" class="btn btn-info pull-right" value="upload" name="upload"><i class="fa fa-check"></i> &nbsp; Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection