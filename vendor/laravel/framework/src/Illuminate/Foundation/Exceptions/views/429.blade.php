@extends('errors::minimal')

@section('title', __('Příliž mnoho požadavků'))
@section('code', '429')
@section('messages', __('UFF... Moc požadavků najednou'))
