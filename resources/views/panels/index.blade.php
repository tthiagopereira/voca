@extends('layouts.panel')
@section('content')


    <div class="alert alert-meu">

        {{--espaço maior (principal)--}}
        <div class="row">

            <div class="col">

                {{--Ultimo Chamado--}}
                <div class="alert alert-dark">
                    <br><br>

                    <div class="row">

                        <span id="id_atual" class="d-none">id atual</span>

                        {{--número chamado--}}
                        <div class="col text-center">
                            <h1><span class="digital panel-1st-call"> 000 </span></h1>
                        </div>

                        {{--local que chamou e linha de cor a seguir--}}
                        <div class="col">

                            {{--local que chamou--}}
                            <div class="alert alert-meu text-center">

                                {{--siga para--}}
                                <span class="audiowide panel-1st-where">
                                Siga para
                                </span>

                                <br>

                                {{--designação do local--}}
                                <span class="audiowide panel-1st-where2">
                                    PXX
                                </span>

                            </div>

                            <br>

                            {{--qual faixa seguir (cor)--}}
                            <div class="alert alert-primary text-center" id="last_call_color_line">

                                <span class="panel-1st-color">Seguir a faixa </span>

                                <div class="panel-1st-color-width d-inline ajuste_panel_color" id="color_name_1"
                                     style="background-color: #000000 !important;"></div>

                            </div>

                        </div>

                    </div>

                    <br><br>

                </div>

            </div>

        </div>

        {{--espaço secundário--}}
        <div class="row">

            {{--chamado 2--}}
            <div class="col">

                <div class="alert alert-danger">

                    <div class="row">

                        {{--numero chamado--}}
                        <div class="col text-center">
                            <h1><span class="digital panel-other-call number2"> 000 </span></h1>
                        </div>

                        {{--Local de comparecimento e linha a seguir--}}
                        <div class="col text-center">

                            {{--siga para--}}
                            <span class="audiowide panel-other-where">
                            Siga para
                            </span>

                            <br>

                            {{--designação do local--}}
                            <span class="audiowide panel-other-where2 where-number2">
                                PXX
                            </span>

                            <br><br>

                            {{--faixa cor--}}
                            <div id="last_call_color_line_number2">
                                <span class="panel-other-where">Faixa </span>

                                <div class="panel-other-color-width color-number2 d-inline"
                                     style="background-color: #000000 !important;"> <span class="ajuste_panel_color" id="color_line_pos_2"></span></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{--chamado 3--}}
            <div class="col">

                <div class="alert alert-danger">

                    <div class="row">

                        {{--numero chamado--}}
                        <div class="col text-center">
                            <h1><span class="digital panel-other-call number3"> 000 </span></h1>
                        </div>

                        {{--Local de comparecimento--}}
                        <div class="col text-center">

                            {{--siga para--}}
                            <span class="audiowide panel-other-where">
                            Siga para
                            </span>

                            <br>

                            {{--designação do local--}}
                            <span class="audiowide panel-other-where2 where-number3">
                                    PXX
                                </span>

                            <br><br>

                            {{--faixa cor--}}
                            <div id="last_call_color_line_number3">
                                <span class="panel-other-where">Faixa </span>

                                <div class="panel-other-color-width color-number3 d-inline"
                                     style="background-color: #000000 !important;"> <span class="ajuste_panel_color" id="color_line_pos_3"></span></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{--chamado 4--}}
            <div class="col">

                <div class="alert alert-danger">

                    <div class="row">

                        {{--numero chamado--}}
                        <div class="col text-center">
                            <h1><span class="digital panel-other-call number4"> 000 </span></h1>
                        </div>

                        {{--Local de comparecimento--}}
                        <div class="col text-center">

                            {{--siga para--}}
                            <span class="audiowide panel-other-where">
                            Siga para
                            </span>

                            <br>

                            {{--designação do local--}}
                            <span class="audiowide panel-other-where2 where-number4">
                                    PXX
                                </span>

                            <br><br>

                            {{--faixa cor--}}
                            <div id="last_call_color_line_number4">
                                <span class="panel-other-where">Faixa </span>

                                <div class="panel-other-color-width color-number4 d-inline"
                                     style="background-color: #000000 !important;"> <span class="ajuste_panel_color" id="color_line_pos_4"></span></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <audio controls style="display: none;">
        <source src='/alert/alert.mp3' type='audio/mp3'>
        Your browser does not support the audio element.
    </audio>




@section('scripts')
    @parent
    <script>


        setInterval(function () {


            $.ajax({
                type: 'GET',
                url: '/panelgeral',

                success: function (data) {
                    // alerta de sucesso

                    if (data[0].id != $("#id_atual").text()) {
                        var song = $("audio")[0];
                        song.play();
                    }

                    // último número
                    $('#id_atual').text(data[0].id);
                    $('.panel-1st-call').text(data[0].number);

                    // se tiver guiche, mostra
                    if (data[0].guiche == null) {

                        $('.panel-1st-where2').text(data[0].where);

                    } else {

                        $('.panel-1st-where2').text(data[0].where + '\n' + data[0].guiche);

                    }

                    // se não tiver cor....
                    if (data[0].color_line == null) {

                        $('#last_call_color_line').hide();

                    } else {

                        $('#last_call_color_line').show();
                        $('.panel-1st-color-width').css('background-color', data[0].color_line);
                        $('#color_name_1').text(data[0].name_color_line);

                    }

                    // numero 2

                    $('.number2').text(data[1].number);

                    // se tiver guiche, mostra
                    if (data[1].guiche == null) {

                        $('.where-number2').text(data[1].where);

                    } else {

                        $('.where-number2').text(data[1].where + '\n' + data[1].guiche);

                    }

                    // se não tiver cor....
                    if (data[1].color_line == null) {

                        $('#last_call_color_line_number2').hide();

                    } else {

                        $('#last_call_color_line_number2').show();
                        $('.color-number2').css('background-color', data[1].color_line);
                        $('#color_line_pos_2').text(data[1].name_color_line);

                    }

                    // numero 3

                    $('.number3').text(data[2].number);

                    // se tiver guiche, mostra
                    if (data[2].guiche == null) {

                        $('.where-number3').text(data[2].where);

                    } else {

                        $('.where-number3').text(data[2].where + '\n' + data[2].guiche);

                    }

                    // se não tiver cor....
                    if (data[2].color_line == null) {

                        $('#last_call_color_line_number3').hide();

                    } else {

                        $('#last_call_color_line_number3').show();
                        $('.color-number3').css('background-color', data[2].color_line);
                        $('#color_line_pos_3').text(data[2].name_color_line);

                    }

                    // numero 4

                    $('.number4').text(data[3].number);

                    // se tiver guiche, mostra
                    if (data[3].guiche == null) {

                        $('.where-number4').text(data[3].where);

                    } else {

                        $('.where-number4').text(data[3].where + '\n' + data[2].guiche);

                    }

                    // se não tiver cor....
                    if (data[3].color_line == null) {

                        $('#last_call_color_line_number4').hide();

                    } else {

                        $('#last_call_color_line_number4').show();
                        $('.color-number4').css('background-color', data[3].color_line);
                        $('#color_line_pos_4').text(data[3].name_color_line);

                    }

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi receber as informações!', 'Falha!', {timeOut: 3000});

                }

            });


        }, 1000);


    </script>

@endsection
@endsection
