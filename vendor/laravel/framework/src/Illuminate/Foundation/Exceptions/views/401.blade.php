@extends('errors::minimal')

@section('title', __('Neautorizováno'))
@section('code', '401')
@section('messages', __('Na tuto stránku nemáte přístup'))
