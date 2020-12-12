@extends('errors::minimal')

@section('title', __('Příliž mnoho požadavků'))
@section('code', '429')
@section('message', __('UFF... Moc požadavků najednou'))
