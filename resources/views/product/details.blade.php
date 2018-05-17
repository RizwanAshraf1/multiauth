@extends('layouts.app')
@section('content')
<div class="row col-md-8 justify-content-center">
<h1>Add New Product - Step 3</h1>
<hr>
<h3>Review Product Details</h3>
<form action={{route("product.details.submit")}} method="post" >
{{ csrf_field() }}
<table class="table">
<tr>
<td>Product Name:</td>
<td><strong>{{$product->name}}</strong></td>
</tr>
<tr>
<td>Product Amount:</td>
<td><strong>{{$product->amount}}</strong></td>
</tr>
<tr>
<td>Product Company:</td>
<td><strong>{{$product->company}}</strong></td>
</tr>
<tr>
<td>Product Available:</td>
<td><strong>{{$product->available ? 'Yes' : 'No'}}</strong></td>
</tr>
<tr>
<td>Product Description:</td>
<td><strong>{{$product->description}}</strong></td>
</tr>
<tr>

<td>Product Image:</td>
<td><strong><img alt="Product Image" src="/storage/productimages/{{$product->productimg}}"/></strong></td>
</tr>
</table>
<a type="button" href={{route("product.info.form")}} class="btn btn-warning">Back to Step 1</a>
<a type="button" href={{route("product.image-upload")}} class="btn btn-warning">Back to Step 2</a>
<button type="submit" class="btn btn-primary">Create Product</button>
</form>
</div>
@endsection
