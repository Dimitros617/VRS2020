@extends('errors::minimal')

@section('title', __('Příliš mnoho požadavků'))
@section('code', '429')
@section('messages', __('UFF... Moc požadavků najednou!'))
