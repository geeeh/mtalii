@extends('welcome')
@section('content')
<div class="add-new">
  <div class="add-new-form">
  <h4> create new company</h4>
  <form class="col-sm-10" method="post" action="{{url('companies')}}" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">company name</label>
      <input type="text" class="form-control" id="companyName" name="name" required aria-describedby="emailHelp" placeholder="company name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">company email</label>
        <input type="email" class="form-control" id="companyEmail" name="email" required aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">company phone</label>
          <input type="text" class="form-control" id="companyPhone" name="phone" required aria-describedby="emailHelp" placeholder="Enter phone">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">company location</label>
            <input type="text" class="form-control" id="companyLocation" name="location" required aria-describedby="emailHelp" placeholder="company location">
          </div>
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control" id="companyDescription" name="description" required rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Proof document</label>
                <input type="file" class="form-control" name="proof" id="companyLocation" required aria-describedby="emailHelp" placeholder="company location">
              </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>
@endsection