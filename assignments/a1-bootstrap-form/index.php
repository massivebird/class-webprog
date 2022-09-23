<!DOCTYPE html>
<head>
   <title>Garrett's Assignment 1</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<html>
   <body>

      <form class="m-3">
	 <!-- First Name, Last Name -->
	 <div class="row mb-3">
	    <div class="col-6">
	       <label class="form-label">First Name</label>
	       <input type="text" class="form-control" />
	    </div>
	    <div class="col-6">
	       <label class="form-label">Last Name</label>
	       <input type="text" class="form-control" />
	    </div>
	 </div>
	 <!-- Address -->
	 <div class="row mb-3">
	    <div class="col-12">
	       <label class="form-label">Address</label>
	       <input type="email" class="form-control" />
	    </div>
	 </div>
	 <!-- City, State, Zip -->
	 <div class="row mb-3">
	    <div class="col-6">
	       <label class="form-label">City</label>
	       <input type="text" class="form-control" />
	    </div>
	    <div class="col-4">
	       <label class="form-label">State</label>
	       <select class="form-select" size="1">
		  <option>Alabama</option>
		  <option>Colorado</option>
		  <option selected>Michigan</option>
	       <option>Texas</option>
		  <option>South Dakota</option>
	       </select>
	    </div>
	    <div class="col-2">
	       <label class="form-label">Zip</label>
	       <input type="text" class="form-control" />
	    </div>
	 </div>
	 <!-- Radio buttons -->
	 <div class="col-12 mb-3">
	    <div class="form-check form-check-inline">
	       <input class="form-check-input" type="radio" name="gender_identity" id="radio1" />
	       <label class="form-check-label" for="radio1">Male</label>
	    </div>
	    <div class="form-check form-check-inline">
	       <input class="form-check-input" type="radio" name="gender_identity" id="radio2" />
	       <label class="form-check-label" for="radio2">Female</label>
	    </div>
	 </div>
	 <div class="col-12">
	    <button type="submit" class="btn btn-primary">Register</button>
	 </div>
      </form>

   </body>
</html>
