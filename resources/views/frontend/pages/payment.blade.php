{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
        $merc_ref=session('unique_order_id') ?? uniqid();
        $amount=session('order_amount') ?? 1000;
        
        $shaString  = '';
        
        $arrData    = array(
            'service_command'    =>'TOKENIZATION',
            'access_code'        =>'BVWNEa8bmcabhQl1fR2D',
            'merchant_identifier'=>'bd50e374',
            'merchant_reference' =>$merc_ref,
            'amount'             => $amount,
            'currency'           =>'SAR',
            'language'           =>'en',
            'return_url'         =>route('confirm-payment'),
        );
        
        ksort($arrData);
        
        foreach ($arrData as $key => $value) {
            $shaString .= "$key=$value";
        }
        
        $shaString = "23oW/FJHzCEmIo3lOv4Ohn#[" . $shaString . "23oW/FJHzCEmIo3lOv4Ohn#[";
        $signature = hash('sha256', $shaString);
        
    @endphp
    
    <form action="https://sbcheckout.PayFort.com/FortAPI/paymentPage" method="POST">
        <input type="hidden" name="service_command" value="TOKENIZATION">
        <input type="hidden" name="access_code" value="BVWNEa8bmcabhQl1fR2D">
        <input type="hidden" name="merchant_identifier" value="bd50e374">
        <input type="hidden" name="merchant_reference" value={{$merc_ref}}>
        <input type="hidden" name="amount" value="{{ $amount}}">
        <input type="hidden" name="currency" value="SAR">
        <input type="hidden" name="language" value="en">
        <input type="hidden" name="return_url" value="{{route('confirm-payment')}}">
        <input type="hidden" name="expiry_date" value="2505">
        <input type="hidden" name="card_number" value="4005550000000001">
        <input type='hidden' name='card_security_code' value='123'>
        <input type="hidden" name="signature" value="{{$signature}}">
        <button type="submit">Pay</button>
    </form>

    <script>

    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--
    Include Tailwind JIT CDN compiler
    More info: https://beyondco.de/blog/tailwind-jit-compiler-via-cdn
    -->
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>

    <!-- Specify a custom Tailwind configuration -->
    <script type="tailwind-config">
    {
        theme: {
            extend: {
            colors: {
                gray: colors.blueGray,
                pink: colors.fuchsia,  
            }
            }
        }
    }
    </script>
    <style>
        .fullpage-loader{
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 9999;
            background: #000000eb;
        }

        .fullpage-loader .loader-wrapper{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            z-index: 9999;
            text-align: center;
        }
    </style>
</head>
<body>
    @include('components.loader')
    <!-- Snippet -->
    <section class="flex flex-col justify-center antialiased bg-gray-200 text-gray-600 min-h-screen p-4">
        <div class="h-full">
            <!-- Card -->
            <div class="max-w-[360px] mx-auto">
                <div class="bg-white shadow-lg rounded-lg mt-9">
                    
                    @if (request()->query('order_id') && request()->query('total_amount'))
                        
                        @php
                            $merc_ref=request()->query('order_id');
                            $amount=request()->query('total_amount');
                            
                            $shaString  = '';
                            
                            $arrData    = array(
                                'service_command'    =>'TOKENIZATION',
                                'access_code'        =>'BVWNEa8bmcabhQl1fR2D',
                                'merchant_identifier'=>'bd50e374',
                                'merchant_reference' =>$merc_ref,
                                'amount'             => $amount,
                                'currency'           =>'SAR',
                                'language'           =>'en',
                                'return_url'         =>route('confirm-payment'),
                            );
                            
                            ksort($arrData);
                            
                            foreach ($arrData as $key => $value) {
                                $shaString .= "$key=$value";
                            }
                            
                            $shaString = "23oW/FJHzCEmIo3lOv4Ohn#[" . $shaString . "23oW/FJHzCEmIo3lOv4Ohn#[";
                            $signature = hash('sha256', $shaString);
                            
                        @endphp
                        <!-- Card header -->
                        <header class="text-center px-5 pb-5">
                            <!-- Avatar -->
                            {{-- <svg class="inline-flex -mt-9 w-[72px] h-[72px] fill-current rounded-full border-4 border-white box-content shadow mb-3" viewBox="0 0 72 72">
                                <path class="text-gray-700" d="M0 0h72v72H0z" />
                                <path class="text-pink-400" d="M30.217 48c.78-.133 1.634-.525 2.566-1.175.931-.65 1.854-1.492 2.769-2.525a30.683 30.683 0 0 0 2.693-3.575c.88-1.35 1.66-2.792 2.337-4.325-1.287 3.3-1.93 5.9-1.93 7.8 0 2.467.914 3.7 2.743 3.7.508 0 1.084-.083 1.727-.25.644-.167 1.169-.383 1.575-.65-.474-.267-.812-.708-1.016-1.325-.203-.617-.305-1.392-.305-2.325 0-.833.11-1.817.33-2.95.22-1.133.534-2.35.94-3.65.407-1.3.898-2.658 1.474-4.075A71.574 71.574 0 0 1 48 28.45c0-.167-.127-.35-.381-.55a5.313 5.313 0 0 0-.94-.575 6.394 6.394 0 0 0-1.245-.45 4.925 4.925 0 0 0-1.194-.175 110.56 110.56 0 0 1-2.49 4.8c-.44.8-.872 1.567-1.295 2.3-.423.733-.804 1.4-1.143 2-1.83 3.033-3.387 5.275-4.675 6.725-1.287 1.45-2.421 2.275-3.404 2.475-.474-.167-.711-.567-.711-1.2 0-1.533.373-3.183 1.118-4.95a23.24 23.24 0 0 1 2.87-4.975c1.169-1.55 2.473-2.875 3.913-3.975s2.836-1.75 4.191-1.95c-.034-.3-.186-.658-.457-1.075a8.072 8.072 0 0 0-.99-1.225c-.39-.4-.797-.75-1.22-1.05-.424-.3-.805-.5-1.143-.6-1.39.067-2.829.692-4.319 1.875-1.49 1.183-2.87 2.658-4.14 4.425a26.294 26.294 0 0 0-3.126 5.75C26.406 38.117 26 40.083 26 41.95c0 1.733.39 3.158 1.169 4.275.779 1.117 1.795 1.708 3.048 1.775Z" />
                            </svg> --}}
                            <img class="img-fluid mx-auto" alt="" src="{{asset('frontend/assets/images/amazon-pay.png')}}">
                            <!-- Card name -->
                            <div class="text-sm font-medium text-gray-500 mt-5">Invoice #{{$merc_ref}}</div>
                        </header>
                        
                        <!-- Card body -->
                        <div class="bg-gray-100 text-center px-5 py-6">
                            <div class="text-sm mb-6"><strong class="font-semibold">Amount </strong>SAR {{$amount}}</div>
                            <form action="https://sbcheckout.PayFort.com/FortAPI/paymentPage" method="POST" class="space-y-3 payment_form">
                                <input type="hidden" name="service_command" value="TOKENIZATION">
                                <input type="hidden" name="access_code" value="BVWNEa8bmcabhQl1fR2D">
                                <input type="hidden" name="merchant_identifier" value="bd50e374">
                                <input type="hidden" name="merchant_reference" value={{$merc_ref}}>
                                <input type="hidden" name="amount" value="{{ $amount}}">
                                <input type="hidden" name="currency" value="SAR">
                                <input type="hidden" name="language" value="en">
                                <input type="hidden" name="return_url" value="{{route('confirm-payment')}}">
                                
                                <input type="hidden" name="signature" value="{{$signature}}">
                                <div class="flex shadow-sm rounded">
                                    <div class="flex-grow">
                                        <input name="card_number" class="text-sm text-gray-800 bg-white rounded-l leading-5 py-2 px-3 placeholder-gray-400 w-full border border-transparent focus:border-indigo-300 focus:ring-0" type="text" placeholder="Card Number" aria-label="Card Number" />
                                    </div>
                                    <div class="flex-none w-[4.8rem]">
                                        <input id="expiry_date" class="text-sm text-gray-800 bg-white leading-5 py-2 px-3 placeholder-gray-400 w-full border border-transparent focus:border-indigo-300 focus:ring-0" type="text" placeholder="YY/MM" aria-label="Expiration" />
                                        <input type="hidden" name="expiry_date">
                                    </div>
                                    <div class="flex-none w-[3.5rem]">
                                        <input name="card_security_code" class="text-sm text-gray-800 bg-white rounded-r leading-5 py-2 px-3 placeholder-gray-400 w-full border border-transparent focus:border-indigo-300 focus:ring-0" type="text" placeholder="CVC" aria-label="CVC" />
                                    </div>
                                </div>
                                <button type="click" style="background: #ff8d00;" class="font-semibold text-sm inline-flex items-center justify-center px-3 py-2 border border-transparent rounded leading-5 shadow transition duration-150 ease-in-out w-full bg-indigo-500 hover:bg-indigo-600 text-white focus:outline-none focus-visible:ring-2 payment_submit_btn">Pay Now</button>
                            </form>
                        </div>
                    @else
                        <div class="text-center">
                            <h1 class="text-2xl font-bold text-gray-800">Payment Failed</h1>
                            <p class="text-gray-600">Please try again later.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.payment_submit_btn').on('click', function(e){
                // $('#fullpage-loader').show();
                
                var expiry = $('#expiry_date').val().replaceAll("/", "");
                
                $('[name="expiry_date"]').val(expiry);
                $('.payment_form').submit();
            });
            
            const expirationdate = document.getElementById('expiry_date');
            var expirationdate_mask = new IMask(expirationdate, {
                mask: 'YY{/}MM',
                groups: {
                    YY: new IMask.MaskedPattern.Group.Range([0, 99]),
                    MM: new IMask.MaskedPattern.Group.Range([1, 12]),
                }
            });
        });
    </script>
</body>
</html>