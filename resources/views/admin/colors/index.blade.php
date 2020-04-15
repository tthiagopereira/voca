@extends('layouts.admin')
@section('content')

    {{--header--}}
    <div class="text-center alert alert-meu">
        <h2><i class="fas fa-paint-brush"></i> <span class="audiowide"> Gerenciamento de Cores </span>
            <i class="fas fa-paint-brush"></i></h2>
    </div>

    {{--campo para cadastro de painéis--}}
    @can('Acesso a administração do sistema')

        <div class="card">

            {{--card header--}}
            <div class="card-header">
                {{ trans('global.color_control') }}
            </div>

            {{--card body--}}
            <div class="card-body">

                <form action="{{ route("admin.colors.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{--Cor PA PIS e PE--}}
                    <div class="row">

                        <div class="col"></div>

                        {{--Cor PA--}}
                        <div class="col alert alert-meu ml-2">

                            {{--cor em si--}}
                            <div class="form-group @if ($color && $color->blank_pa == 1) d-none @endif " id="my_pa_color">
                                <label for="color_pa">Cor PA</label>
                                <input type="color" id="color_pa" name="color_pa" class="form-control"
                                       value= @if ($color) "{{ $color->color_pa }}" @else "#000000" @endif >

                                <p class="helper-block">
                                    Insira a cor da linha (PA)
                                </p>
                            </div>

                            {{--nome da cor--}}
                            <div class="form-group @if ($color && $color->blank_pa == 1) d-none @endif " id="name_pa_color" >
                                <label for="name_color_pa">Nome cor PA</label>
                                <input type="text" id="name_color_pa" name="name_color_pa" class="form-control"
                                       value=@if ($color) "{{ $color->name_color_pa }}" @else "" @endif >

                                <p class="helper-block">
                                    Insira o nome da cor da linha (PA)
                                </p>
                            </div>

                            {{--no color--}}
                            <div class="form-check text-center">
                                <input class="form-check-input" type="checkbox" value="1" id="blank_pa" name="blank_pa" @if ($color && $color->blank_pa == 1) checked @endif >
                                <label class="form-check-label" for="blank_pa">
                                    Sem cor (PA)
                                </label>
                            </div>

                        </div>

                        {{--Cor PIS--}}
                        <div class="col alert alert-meu ml-2">

                            {{--cor em si--}}
                            <div class="form-group @if ($color && $color->blank_pis == 1) d-none @endif " id="my_pis_color">
                                <label for="color_pis">Cor PIS</label>
                                <input type="color" id="color_pis" name="color_pis" class="form-control"
                                       value= @if ($color) "{{ $color->color_pis }}" @else "#000000" @endif >

                                <p class="helper-block">
                                    Insira a cor da linha (PIS)
                                </p>
                            </div>

                            {{--nome da cor--}}
                            <div class="form-group @if ($color && $color->blank_pis == 1) d-none @endif " id="name_pis_color" >
                                <label for="name_color_pis">Nome cor PIS</label>
                                <input type="text" id="name_color_pis" name="name_color_pis" class="form-control"
                                       value= @if ($color) "{{ $color->name_color_pis }}" @else "" @endif >

                                <p class="helper-block">
                                    Insira o nome da cor da linha (PIS)
                                </p>
                            </div>

                            {{---no color--}}
                            <div class="form-check text-center">
                                <input class="form-check-input" type="checkbox" value="1" id="blank_pis" name="blank_pis" @if ($color && $color->blank_pis == 1) checked @endif >
                                <label class="form-check-label" for="blank_pis">
                                    Sem cor (PIS)
                                </label>
                            </div>

                        </div>

                        {{--Cor PE--}}
                        <div class="col alert alert-meu ml-2">

                            {{--cor em si--}}
                            <div class="form-group @if ($color && $color->blank_pe == 1) d-none @endif " id="my_pe_color" >
                                <label for="color_pe">Cor PE</label>
                                <input type="color" id="color_pe" name="color_pe" class="form-control"
                                       value= @if ($color) "{{ $color->color_pe }}" @else "#000000" @endif >

                                <p class="helper-block">
                                    Insira a cor da linha (PE)
                                </p>
                            </div>

                            {{--nome da cor--}}
                            <div class="form-group @if ($color && $color->blank_pe == 1) d-none @endif " id="name_pe_color" >
                                <label for="name_color_pe">Nome cor PE</label>
                                <input type="text" id="name_color_pe" name="name_color_pe" class="form-control"
                                       value= @if ($color) "{{ $color->name_color_pe }}" @else "" @endif >

                                <p class="helper-block">
                                    Insira o nome da cor da linha (PE)
                                </p>
                            </div>

                            {{--checkbox no color--}}
                            <div class="form-check text-center">
                                <input class="form-check-input" type="checkbox" value="1" id="blank_pe" name="blank_pe" @if ($color && $color->blank_pe == 1) checked @endif >
                                    Sem cor (PE)
                                </label>
                            </div>

                        </div>

                        <div class="col"></div>

                    </div>

                    {{--submit--}}
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                    <div class="text-center">
                            <input class="btn btn-outline-success btn-block" type="submit" value="{{ trans('global.adjust') }}">
                        </div>
                        <div class="col-3"></div>

                    </div>
                    </div>

                </form>
            </div>

        </div>

    @endcan







@section('scripts')
    @parent
    <script>

        $(function () {

            // esconde cor do PA
            $(document).on('click', '#blank_pa', function () {
                if($(this).prop('checked') == true){

                    $('#my_pa_color').fadeOut();
                    $('#name_pa_color').fadeOut();

                } else {

                    $('#my_pa_color').fadeIn().removeClass('d-none');
                    $('#name_pa_color').fadeIn().removeClass('d-none');
                }
            });

            // esconde cor do PIS
            $(document).on('click', '#blank_pis', function () {
                if($(this).prop('checked') == true){

                    $('#my_pis_color').fadeOut();
                    $('#name_pis_color').fadeOut();

                } else {

                    $('#my_pis_color').fadeIn().removeClass('d-none');
                    $('#name_pis_color').fadeIn().removeClass('d-none');
                }
            });

            // esconde cor do PE
            $(document).on('click', '#blank_pe', function () {
                if($(this).prop('checked') == true){

                    $('#my_pe_color').fadeOut();
                    $('#name_pe_color').fadeOut();
                } else {

                    $('#my_pe_color').fadeIn().removeClass('d-none');
                    $('#name_pe_color').fadeIn().removeClass('d-none');
                }
            });

        });

            // errors
        @if (Request::session()->has('error'))

        toastr.error('{{ Request::session()->get('error') }}', 'Erro!', {
            timeOut: 4000,
            closeButton: true,
            progressBar: true
        });

        // Success
        @elseif (Request::session()->has('acao'))

        toastr.success('{{ Request::session()->get('acao') }}', 'Sucesso!', {
            timeOut: 4000,
            closeButton: true,
            progressBar: true
        });

        @endif

    </script>

@endsection
@endsection
