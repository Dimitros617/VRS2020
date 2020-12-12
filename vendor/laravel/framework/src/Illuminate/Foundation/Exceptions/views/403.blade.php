@extends('errors::minimal')

@section('title', __('Neoprávněný přístup'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Pro tuto stránku nemáte dostatečná oprávnění'))
