              @php
                                function konwersja($el)
                                {
                                    if ($el < 10) return "00".$el;
                                    if (($el >=10) && ($el <99)) return "0".$el;
                                    if ($el >99) return "$el";
                                }
                @endphp
