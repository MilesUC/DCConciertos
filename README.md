# Entrega 3 IIC2413 2022-2

En esta entrega se implementó una plataforma para la gestión de artistas y productoras

Integrantes:

- Diego Milla y Clemente Streeter (Grupo 21)
- Tomás Alcalde y Lucas Betancourt (Grupo 22)

## Información de login

Se implementó un botón en la página principal para dirigirse al login del artista/productora y otro botón
que se encarga de importar los artistas y productoras y transformarlos en usuarios con una contraseña aleatoria
con la cual se puede ingresar y ver la información propia del usuario en cuestión. Para mayor facilidad,
este botón ya fue activado, por lo que se presenta la información generada al final de este README.


Para generar los usuarios de las distintas cuentas se utilizan las siguientes reglas:
- Para los nombres de usuario se cambian los espacios por guion bajo y se transforman mayúsculas en minúsculas
- Para las contraseñas se utiliza un numero aleatorio de alrededor de 10 cifras

La implementación de esta funcionalidad se encuentra en el archivo `sql/funciones/importar_usuarios.sql`.


## Procedimientos almacenados

Los archivos que contienen el código de las funcioes de procedimientos almacenados en lenguaje PL/pgSQL se encuentra en la ruta `sql/funciones` y las funciones corresponden a las siguientes:

- `importar_usuarios()` : Se encarga de crear y cargar la tabla usuarios con los datos de artistas y productoras
- `validar_login(usuario, password)` : Se encarga de comprobar que el inicio de sesión sea válido
- `get_tipo(usuario, password)` : Se encarga de retornar el tipo de usuario
- `crear_evento(nombre, artista, recinto, productora, fecha_inicio, fecha_termino)` : Se encarga de crear un evento y cargarlo a la tabla nuevos_eventos
- `aceptar_evento(id_evento)` : Se encarga de modificar el atributo aprobado de un evento a aceptado
- `rechazar_evento(id_evento)` : Se encarga de modificar el atributo aprobado de un evento a rechazado

## Relación entre las localizaciones en el código y la funcionalidad

Se presenta a continuación la funcionalidad que implementan los archivos más importantes dentro de `Sites`:

- `index.php`: Página principal.
- `views/login.php`: Implementa el formulario de login.
- `views/login_validation.php`: Implementa la funcionalidad de validar login.
- `views/logout.php`: Cierra la sesión y vuelve a la página principal.
- `views/form.php`: Implementa el formulario de crear evento.
- `views/filtrar.php`: Implementa la funcionalidad de filtrar por fecha.
- `views/limpiar_filtro.php`: Se encarga de resetear el filtro.
- `consultas/importar_usuarios.php`: Implementa la función de importar los distintos usuarios.
- `consultas/crear_evento.php`: Implementa la función de crear un evento.
- `consultas/aceptar_evento.php`: Implementa la función de aceptar un evento determinado.
- `consultas/rechazar_evento.php`: Implementa la función de rechazar un evento determinado.


## Observaciones

- A la hora de crear eventos, tal como informa el formulario, se deben ingresar los artistas separados por coma y las fechas en formato DD-MM-AAAA
- Al importar usuarios, existían productoras con el mismo nombre pero distinto país, para estas se creó un único usuario con contraseña

## Supuestos

Se realizaron los siguientes supuestos y acotaciones:

- Para los eventos dados por el equipo docente, estos se consideran como ya programados, haciendo la distinción con los nuevos eventos, los cuales pueden ser aprobados, rechazados o estar en espera de aprobación.


## Usuarios

| id  |                                username                                | contrasena |    tipo     |
|-----|------------------------------------------------------------------------|------------|-------------|
|   1 | duki                                                                   | 583042135  | artista     |
|   2 | backstreet_boys                                                        | 721215287  | artista     |
|   3 | michael_jackson                                                        | 619085715  | artista     |
|   4 | mon_laferte                                                            | 750876343  | artista     |
|   5 | khea                                                                   | 781857196  | artista     |
|   6 | jason_derulo                                                           | 550030906  | artista     |
|   7 | pink_floyd                                                             | 495573731  | artista     |
|   8 | drake                                                                  | 686256278  | artista     |
|   9 | nicky_jam                                                              | 840097882  | artista     |
|  10 | lola_indigo                                                            | 794542721  | artista     |
|  11 | ñengo_flow                                                             | 216002516  | artista     |
|  12 | big_time_rush                                                          | 281904616  | artista     |
|  13 | elton_john                                                             | 36480162   | artista     |
|  14 | paulo_londra                                                           | 63976520   | artista     |
|  15 | maria_becerra                                                          | 122067463  | artista     |
|  16 | iggy_azalea                                                            | 195487936  | artista     |
|  17 | daniel_caesar                                                          | 609981873  | artista     |
|  18 | rels_b                                                                 | 86289747   | artista     |
|  19 | feid                                                                   | 146205982  | artista     |
|  20 | rolling_stones                                                         | 953002303  | artista     |
|  21 | prince_royce                                                           | 481309971  | artista     |
|  22 | j_balvin                                                               | 626326850  | artista     |
|  23 | camila_cabello                                                         | 424159836  | artista     |
|  24 | tiago_pzk                                                              | 399772523  | artista     |
|  25 | rosalia                                                                | 682868426  | artista     |
|  26 | santaferia                                                             | 75888887   | artista     |
|  27 | drefquila                                                              | 34460707   | artista     |
|  28 | gepe                                                                   | 398224563  | artista     |
|  29 | masked_wolf                                                            | 757377748  | artista     |
|  30 | kesha                                                                  | 40508759   | artista     |
|  31 | billie_eilish                                                          | 660022681  | artista     |
|  32 | soda_stereo                                                            | 840962708  | artista     |
|  33 | twice                                                                  | 791500583  | artista     |
|  34 | belinda                                                                | 53697699   | artista     |
|  35 | jonas_brothers_                                                        | 511449650  | artista     |
|  36 | olivia_rodrigo                                                         | 965864990  | artista     |
|  37 | emilia                                                                 | 635859495  | artista     |
|  38 | red_hot_chili_peppers                                                  | 515615794  | artista     |
|  39 | sebastian_yatra                                                        | 453518181  | artista     |
|  40 | ac/dc                                                                  | 857164307  | artista     |
|  41 | nicky_romero                                                           | 809689106  | artista     |
|  42 | becky_g                                                                | 127381682  | artista     |
|  43 | martin_garrix                                                          | 651411402  | artista     |
|  44 | morat                                                                  | 417212310  | artista     |
|  45 | cazzu                                                                  | 258184564  | artista     |
|  46 | dj_snake                                                               | 38038562   | artista     |
|  47 | maluma                                                                 | 120586398  | artista     |
|  48 | francisca_valenzuela                                                   | 662870590  | artista     |
|  49 | coldplay                                                               | 512644996  | artista     |
|  50 | afrojack                                                               | 967647835  | artista     |
|  51 | farruko                                                                | 695739011  | artista     |
|  52 | hardwell                                                               | 993905143  | artista     |
|  53 | avicii                                                                 | 465153312  | artista     |
|  54 | daft_punk                                                              | 61804738   | artista     |
|  55 | san_smith                                                              | 205377328  | artista     |
|  56 | mabel                                                                  | 794660155  | artista     |
|  57 | lewis_capaldi                                                          | 306280304  | artista     |
|  58 | tini_stoessel                                                          | 780419868  | artista     |
|  59 | imagine_dragons                                                        | 77342421   | artista     |
|  60 | zayn                                                                   | 951575167  | artista     |
|  61 | rbd                                                                    | 659796952  | artista     |
|  62 | natti_natasha                                                          | 852867206  | artista     |
|  63 | bebe_rexha                                                             | 438682392  | artista     |
|  64 | tiesto                                                                 | 325320863  | artista     |
|  65 | pearl_jam                                                              | 384370316  | artista     |
|  66 | steve_aoki                                                             | 134146643  | artista     |
|  67 | dua_lipa                                                               | 695144849  | artista     |
|  68 | bruno_mars                                                             | 25626385   | artista     |
|  69 | javiera_mena_                                                          | 278594469  | artista     |
|  70 | rita_ora                                                               | 979800797  | artista     |
|  71 | denisse_rossenthal                                                     | 968915343  | artista     |
|  72 | khalid                                                                 | 258050804  | artista     |
|  73 | mecano                                                                 | 230477554  | artista     |
|  74 | demi_lovato                                                            | 693789429  | artista     |
|  75 | eminem                                                                 | 978906197  | artista     |
|  76 | luar_la_l                                                              | 194417237  | artista     |
|  77 | romeo_santos                                                           | 481795238  | artista     |
|  78 | zedd                                                                   | 381846446  | artista     |
|  79 | aerosmith                                                              | 509838651  | artista     |
|  80 | eagles                                                                 | 552428129  | artista     |
|  81 | bee_gees                                                               | 245795854  | artista     |
|  82 | niall_horan                                                            | 617133427  | artista     |
|  83 | abba                                                                   | 531633498  | artista     |
|  84 | ed_sheeran                                                             | 535774653  | artista     |
|  85 | rihanna                                                                | 115979043  | artista     |
|  86 | sech                                                                   | 164968697  | artista     |
|  87 | rauw_alejando                                                          | 999425308  | artista     |
|  88 | marshmello                                                             | 305128534  | artista     |
|  89 | 5_seconds_of_summer                                                    | 554581288  | artista     |
|  90 | alan_walker                                                            | 354419542  | artista     |
|  91 | dimitri_vegas                                                          | 40162180   | artista     |
|  92 | hansen                                                                 | 934681558  | artista     |
|  93 | lady_gaga                                                              | 350615957  | artista     |
|  94 | fito_paez                                                              | 777568270  | artista     |
|  95 | kygo                                                                   | 470694035  | artista     |
|  96 | paramore                                                               | 710909222  | artista     |
|  97 | blackpink                                                              | 715593618  | artista     |
|  98 | trueno                                                                 | 858897035  | artista     |
|  99 | tate_mcrae                                                             | 704060332  | artista     |
| 100 | duncan_laurence                                                        | 893146315  | artista     |
| 101 | megan_trainor                                                          | 645274571  | artista     |
| 102 | cirque_du_solei                                                        | 499717872  | artista     |
| 103 | madonna                                                                | 98046809   | artista     |
| 104 | the_martinez_brothers                                                  | 563168233  | artista     |
| 105 | beele                                                                  | 150980194  | artista     |
| 106 | manuel_turizo                                                          | 763746879  | artista     |
| 107 | swedish_house_mafia                                                    | 648829115  | artista     |
| 108 | james_arthur                                                           | 717674502  | artista     |
| 109 | armin_van_buuren                                                       | 865256605  | artista     |
| 110 | chris_brown                                                            | 243265658  | artista     |
| 111 | sza                                                                    | 801587971  | artista     |
| 112 | harry_styles                                                           | 218424482  | artista     |
| 113 | gustavo_cerati                                                         | 593291859  | artista     |
| 114 | princesa_alba                                                          | 909926955  | artista     |
| 115 | bon_jovi                                                               | 661441290  | artista     |
| 116 | conan_gray                                                             | 915428651  | artista     |
| 117 | nicki_nicole                                                           | 430821190  | artista     |
| 118 | bad_bunny                                                              | 504879261  | artista     |
| 119 | ellie_gowlding                                                         | 367095940  | artista     |
| 120 | los_prisioneros                                                        | 145355864  | artista     |
| 121 | jennifer_lopez                                                         | 746829354  | artista     |
| 122 | sam_smith                                                              | 719844213  | artista     |
| 123 | ozuna                                                                  | 114583327  | artista     |
| 124 | kudai                                                                  | 717075122  | artista     |
| 125 | pailita                                                                | 358793384  | artista     |
| 126 | jessie_j                                                               | 940077457  | artista     |
| 127 | polima_westcoast                                                       | 770763990  | artista     |
| 128 | diplo                                                                  | 406569852  | artista     |
| 129 | anitta                                                                 | 661273789  | artista     |
| 130 | katy_perry                                                             | 303357540  | artista     |
| 131 | a7s                                                                    | 130533193  | artista     |
| 132 | lana_del_rey                                                           | 262480998  | artista     |
| 133 | r3hab                                                                  | 935235630  | artista     |
| 134 | justin_bieber                                                          | 433524326  | artista     |
| 135 | karol_g                                                                | 285525384  | artista     |
| 136 | louis_tomlinson                                                        | 680070736  | artista     |
| 137 | wisin_&_yandel                                                         | 23565901   | artista     |
| 138 | nathy_peluso                                                           | 855468760  | artista     |
| 139 | post_malone                                                            | 876429312  | artista     |
| 140 | c_tangana                                                              | 134839007  | artista     |
| 141 | exo                                                                    | 543992405  | artista     |
| 142 | taylor_swift                                                           | 729336838  | artista     |
| 143 | jordan_23                                                              | 989717860  | artista     |
| 144 | black_eyed_peas                                                        | 717426677  | artista     |
| 145 | one_direction                                                          | 688254016  | artista     |
| 146 | kanye_west                                                             | 859160270  | artista     |
| 147 | robin_schulz                                                           | 379754402  | artista     |
| 148 | maroon_5                                                               | 609461709  | artista     |
| 149 | oasis                                                                  | 868301125  | artista     |
| 150 | sia                                                                    | 654884922  | artista     |
| 151 | daddy_yankee                                                           | 499043948  | artista     |
| 152 | el_alfa                                                                | 456928912  | artista     |
| 153 | cami                                                                   | 287040782  | artista     |
| 154 | tool                                                                   | 842187859  | artista     |
| 155 | alesso                                                                 | 406178413  | artista     |
| 156 | wos                                                                    | 195400495  | artista     |
| 157 | miley_cyrus                                                            | 281297559  | artista     |
| 158 | selena_gomez                                                           | 722536406  | artista     |
| 159 | paloma_mami                                                            | 99222590   | artista     |
| 160 | los_tres                                                               | 362574328  | artista     |
| 161 | the_weeknd                                                             | 685012871  | artista     |
| 162 | shakira                                                                | 953241649  | artista     |
| 163 | travis_scott                                                           | 751477531  | artista     |
| 164 | beto_cuevas                                                            | 791208251  | artista     |
| 165 | new_kids_on_the_block                                                  | 746122427  | artista     |
| 166 | beyonce                                                                | 426029488  | artista     |
| 167 | major_lazer                                                            | 969428880  | artista     |
| 168 | camilo                                                                 | 943491886  | artista     |
| 169 | snow                                                                   | 384051136  | artista     |
| 170 | bts                                                                    | 420737191  | artista     |
| 171 | big_bang                                                               | 765062743  | artista     |
| 172 | calvin_harris                                                          | 50581266   | artista     |
| 173 | one_republic                                                           | 957473971  | artista     |
| 174 | marcianeke                                                             | 861628965  | artista     |
| 175 | doja_cat                                                               | 855560006  | artista     |
| 176 | lali_esposito                                                          | 823472379  | artista     |
| 177 | queen                                                                  | 713170415  | artista     |
| 178 | quevedo                                                                | 36601120   | artista     |
| 179 | david_guetta                                                           | 44724509   | artista     |
| 180 | u2                                                                     | 359275159  | artista     |
| 181 | reik                                                                   | 773828838  | artista     |
| 182 | anderson_paak                                                          | 398951455  | artista     |
| 183 | the_beatles                                                            | 377561082  | artista     |
| 184 | la_ley                                                                 | 176549323  | artista     |
| 185 | my_chemical_romance                                                    | 791051518  | artista     |
| 186 | cardi_b                                                                | 167768166  | artista     |
| 187 | anuel_aa                                                               | 20519374   | artista     |
| 188 | skrillex                                                               | 161610000  | artista     |
| 189 | radiohead                                                              | 213190604  | artista     |
| 190 | cris_mj                                                                | 2318573    | artista     |
| 191 | charly_garcia                                                          | 136492699  | artista     |
| 192 | ariana_grande                                                          | 822119411  | artista     |
| 193 | pablo_chill-e                                                          | 797781243  | artista     |
| 194 | shawn_mendes                                                           | 439706535  | artista     |
| 195 | wiz_khalifa                                                            | 580295450  | artista     |
| 196 | la_oreja_de_van_gogh                                                   | 243037218  | artista     |
| 197 | bizarrap                                                               | 415105701  | artista     |
| 198 | nicki_minaj                                                            | 460726973  | artista     |
| 199 | camila                                                                 | 924714194  | artista     |
| 200 | mercedes_sosa                                                          | 781879346  | artista     |
| 201 | letsgo_company                                                         | 50827423   | productora  |
| 202 | live_nation                                                            | 159140954  | productora  |
| 203 | janos_eventos                                                          | 980172503  | productora  |
| 204 | fullevent.de                                                           | 974660569  | productora  |
| 205 | b+d_events                                                             | 7820669    | productora  |
| 206 | prospero_producciones                                                  | 222998127  | productora  |
| 207 | producciones_oz_limitada                                               | 636503840  | productora  |
| 208 | dnj_producciones                                                       | 640893012  | productora  |
| 209 | espectaculos_gallo                                                     | 744531354  | productora  |
| 210 | eventveranstalter_hamburg                                              | 747243995  | productora  |
| 211 | bizarro_producciones_limitada                                          | 30364085   | productora  |
| 212 | sony_music_entertainment_chile_s.a.                                    | 456264132  | productora  |
| 213 | sach_producciones_y_eventos_limitada                                   | 261835514  | productora  |
| 214 | multimusica_s.a.                                                       | 754397412  | productora  |
| 215 | somosfk                                                                | 926630534  | productora  |
| 216 | efeunodos                                                              | 626395808  | productora  |
| 217 | onanof_producciones_limitada                                           | 982910507  | productora  |
| 218 | aguero_producciones_limitada                                           | 939918922  | productora  |
| 219 | sono_producciones_limitada                                             | 950048477  | productora  |
| 220 | el_magno_producciones_s.r.l._                                          | 956314616  | productora  |
| 221 | arte3                                                                  | 259743963  | productora  |
| 222 | ozono_y_piedra_mala_producciones_                                      | 331991271  | productora  |
| 223 | padrao_bull_prime                                                      | 270840474  | productora  |
| 224 | cucarro_producciones_limitada                                          | 920478707  | productora  |
| 225 | bafochi_ltda                                                           | 912318214  | productora  |
| 226 | yataco                                                                 | 278396377  | productora  |
| 227 | casa_eventos                                                           | 344568061  | productora  |
| 228 | brasil_stands                                                          | 40572410   | productora  |
| 229 | german_norambuena_y_cia_ltda                                           | 67130540   | productora  |
| 230 | your_dream                                                             | 978233390  | productora  |
| 231 | rove.me                                                                | 844912598  | productora  |
| 232 | charco_booking_spa                                                     | 356585380  | productora  |
| 233 | eventos_flores_y_padilla_limitada                                      | 343519379  | productora  |
| 234 | reverb_-_productora_de_eventos                                         | 461221402  | productora  |
| 235 | bautrip                                                                | 474051118  | productora  |
| 236 | expat                                                                  | 305354131  | productora  |
| 237 | soc_concesionaria_arena_bicentenario_s_a                               | 550430146  | productora  |
| 238 | productora_dreams_pro_limitada                                         | 795752619  | productora  |
| 239 | aeg                                                                    | 557887451  | productora  |
| 240 | lotus_sonar_spa                                                        | 314793629  | productora  |
| 241 | k_producciones_s.a.                                                    | 241995655  | productora  |
| 242 | actitud_creaciones                                                     | 457808195  | productora  |
| 243 | alva_producciones_ltda                                                 | 354628708  | productora  |
| 244 | eventos_y_banqueteria_leonor_contreras_hormazabal_e.i.r.l.             | 687160579  | productora  |
| 245 | eventlocations_munchen                                                 | 55037466   | productora  |
| 246 | horwath_productions_inc.                                               | 311036331  | productora  |
| 247 | av_company                                                             | 650263558  | productora  |
| 248 | ecopass                                                                | 327143460  | productora  |
| 249 | litmind                                                                | 860803348  | productora  |
| 250 | glamour                                                                | 894089623  | productora  |
| 251 | beone_-_entertainment_limitada                                         | 261731695  | productora  |
| 252 | backstage_rockstore_s.a.                                               | 907291213  | productora  |
| 253 | revelation                                                             | 630585117  | productora  |
| 254 | agencia_360                                                            | 560684519  | productora  |
| 255 | grandes_eventos                                                        | 499406569  | productora  |
| 256 | ditecsur                                                               | 631810328  | productora  |
| 257 | apparcel_producciones_limitada                                         | 92063987   | productora  |
| 258 | merci_entertainment_spa                                                | 112393367  | productora  |
| 259 | audio_level_eventos                                                    | 889528638  | productora  |
| 260 | rocko_saroni_eventos                                                   | 728235298  | productora  |
| 261 | xceed                                                                  | 870195791  | productora  |
| 262 | dives_eirl_-_productora_de_evento                                      | 561133547  | productora  |
| 263 | eventos_mudness_limitada                                               | 662106822  | productora  |
| 264 | blackgaton                                                             | 673713761  | productora  |
| 265 | ck_events_germany                                                      | 821174828  | productora  |
| 266 | entertainment_group                                                    | 480524552  | productora  |
| 267 | producciones_walter_beat                                               | 761383332  | productora  |
| 268 | hartmann_studios                                                       | 348041502  | productora  |
| 269 | productora_de_eventos_moviefan_limitada                                | 716641656  | productora  |
| 270 | andres_gardeweg_producciones_e.i.r.l                                   | 491225125  | productora  |
| 271 | meta_proyectos_sa                                                      | 728169713  | productora  |
| 272 | agosin_eventos                                                         | 339188862  | productora  |
| 273 | comercial_visto_bueno_producciones_limitada                            | 682087904  | productora  |
| 274 | comercial_caupolican_limitada                                          | 979140482  | productora  |
| 275 | eventos_f.c                                                            | 483280609  | productora  |
| 276 | md+                                                                    | 439532531  | productora  |
| 277 | carpas_karen_ltda                                                      | 780731371  | productora  |
| 278 | onlygroundmusic                                                        | 386724319  | productora  |
| 279 | gj_comunicaciones                                                      | 259116437  | productora  |
| 280 | gl_events                                                              | 533638251  | productora  |
| 281 | k_international_                                                       | 632507725  | productora  |
| 282 | sonnica_producciones                                                   | 831849848  | productora  |
| 283 | europages                                                              | 85491542   | productora  |
| 284 | colors_producciones_limitada                                           | 53145508   | productora  |
| 285 | contenidos_y_entretenimientos_s.a._                                    | 815875650  | productora  |
| 286 | gn_producciones                                                        | 396865338  | productora  |
| 287 | csi_dmc                                                                | 942518933  | productora  |
| 288 | energika_eventos_limitada                                              | 563621026  | productora  |
| 289 | lotus_producciones_limitada                                            | 194622426  | productora  |
| 290 | eventos_luis_maturana_ortega_e.i.r.l                                   | 959074084  | productora  |
| 291 | mca                                                                    | 7317091    | productora  |
| 292 | cultura_ciudadana                                                      | 845341819  | productora  |
| 293 | grupo_previa_s.a.                                                      | 997665255  | productora  |
| 294 | manatua.nz                                                             | 685231196  | productora  |
| 295 | mundo_epika                                                            | 105189049  | productora  |
| 296 | lets_dance                                                             | 668623242  | productora  |
| 297 | comercial_cueto_balmaceda_limitada                                     | 39985683   | productora  |
| 298 | productora_babilonia_limitada                                          | 334559118  | productora  |
| 299 | t4f_entretenimientos_argentina_                                        | 245571135  | productora  |
| 300 | entretenciones_jovi_limitada                                           | 868946764  | productora  |
| 301 | event_management_nz                                                    | 568428999  | productora  |
| 302 | indyrock                                                               | 870749729  | productora  |
| 303 | la_crypta_s.a._                                                        | 897383683  | productora  |
| 304 | canada_eventos                                                         | 962795221  | productora  |
| 305 | noix_producciones_limitada                                             | 836427689  | productora  |
| 306 | productora_energy_in_motion_limitada                                   | 902525644  | productora  |
| 307 | mgc                                                                    | 809533299  | productora  |
| 308 | tonicas_producciones_                                                  | 467439438  | productora  |
| 309 | ariel_diwan_producciones_s.r.l._                                       | 224120963  | productora  |
| 310 | trimade_eventos_limitada                                               | 499314852  | productora  |
| 311 | huma_producciones                                                      | 785389354  | productora  |
| 312 | ultrabeatman_entretenimiento_puro                                      | 993228756  | productora  |
| 313 | urban_music                                                            | 920379954  | productora  |
| 314 | glovox_producciones_limitada                                           | 573801034  | productora  |
| 315 | capsule_producciones_spa                                               | 903422833  | productora  |
| 316 | feg_entretenimientos                                                   | 652131596  | productora  |
| 317 | global_journey                                                         | 344520399  | productora  |
| 318 | sydney_worldpride                                                      | 412518666  | productora  |
| 319 | producciones_y_eventos_empire_digital_limitada                         | 471286933  | productora  |
| 320 | lino_patalano_                                                         | 98886743   | productora  |
| 321 | youtooproject                                                          | 409755991  | productora  |
| 322 | centro_de_eventos_dona_sofia                                           | 960872849  | productora  |
| 323 | el_vasco_producciones_                                                 | 192014587  | productora  |
| 324 | freedom_eventos                                                        | 709335643  | productora  |
| 325 | privadate                                                              | 797609217  | productora  |
| 326 | millie_millgate                                                        | 37207070   | productora  |
| 327 | sociedad_comercial_metapega_producciones_limitada                      | 996399996  | productora  |
| 328 | el_trebol                                                              | 763086620  | productora  |
| 329 | productora_chile_espectaculos                                          | 830539608  | productora  |
| 330 | tolten_eventos                                                         | 934661032  | productora  |
| 331 | brl_eventos                                                            | 95838892   | productora  |
| 332 | cym_musicos_-_musica_y_asesorias_musicales                             | 684036076  | productora  |
| 333 | carlos_alberto_perez_alegria_productora_de_eventos_e.i.r.l             | 585125522  | productora  |
| 334 | producciones_musicales_massivo_reccords_limitada                       | 558046605  | productora  |
| 335 | kahnevents_gmbh                                                        | 578871202  | productora  |
| 336 | actividades_de_entretenimiento_n.c._p_fabiola_patricia_fabres_cerda_em | 192479779  | productora  |
| 337 | recreo_producciones_spa                                                | 194489260  | productora  |
| 338 | kibon_video                                                            | 789902048  | productora  |
| 339 | centro_de_eventos_aravena_malloco                                      | 309477826  | productora  |
| 340 | mayam_producciones                                                     | 817244143  | productora  |
| 341 | iragons_party                                                          | 38674023   | productora  |
| 342 | globscorp                                                              | 655019136  | productora  |
| 343 | artes_y_eventos_internacionales_s.a._                                  | 686006613  | productora  |
| 344 | g_y_t_business_group_spa                                               | 426753651  | productora  |
| 345 | alto_la_torre                                                          | 735873012  | productora  |
| 346 | universal_circus                                                       | 791393925  | productora  |
| 347 | cmg_audio_visual                                                       | 639789114  | productora  |
| 348 | queenstown_event_company                                               | 976128402  | productora  |
| 349 | club_providencia                                                       | 624407749  | productora  |
| 350 | fg_producciones                                                        | 988734614  | productora  |
| 351 | factor_eventos                                                         | 948476183  | productora  |
| 352 | piedra_mala_producciones_                                              | 385828917  | productora  |
| 353 | producciones_seven_time_entertainment_group_limitada                   | 191911077  | productora  |
| 354 | bierlinerin                                                            | 139950446  | productora  |
| 355 | the_imagos                                                             | 820460986  | productora  |
| 356 | dg_medios_y_espectaculos_s.a.                                          | 609178241  | productora  |
| 357 | sinstress_eventos                                                      | 669177943  | productora  |
| 358 | un_plan_producciones_                                                  | 898681966  | productora  |
| 359 | animationphoenix                                                       | 786150115  | productora  |
| 360 | palma_y_compania_limitada                                              | 395106658  | productora  |
| 361 | venue_hire_sydney                                                      | 594604439  | productora  |
| 362 | grus_                                                                  | 944764495  | productora  |
| 363 | wow.cl                                                                 | 175120707  | productora  |
| 364 | time_for_fun_(t4f)                                                     | 783071321  | productora  |
| 365 | blao                                                                   | 482180341  | productora  |
| 366 | eventseye                                                              | 843011741  | productora  |
| 367 | atomic_films                                                           | 34298671   | productora  |
| 368 | yellow_house                                                           | 894364200  | productora  |
| 369 | club_de_la_union                                                       | 30892691   | productora  |
| 370 | weise_y_asociados_limitada                                             | 617984206  | productora  |
| 371 | los_angeles_av_production                                              | 873289623  | productora  |
| 372 | x_producciones                                                         | 413580944  | productora  |
| 373 | t-entertainment_multi_producciones_(sebastian_torres_cortes_e.i.r.l).  | 413511832  | productora  |
| 374 | lotus_festival_s.a.                                                    | 953172998  | productora  |
| 375 | nikkita_producciones_spa                                               | 434077362  | productora  |
| 376 | vision_world_producciones_limitada                                     | 232185144  | productora  |
| 377 | street_machine_producciones_s.a.                                       | 723585283  | productora  |
| 378 | nachhaltige_events                                                     | 217652726  | productora  |
| 379 | avant_garde_rp                                                         | 51799709   | productora  |
| 380 | top_brand                                                              | 889771199  | productora  |
| 381 | planet_events                                                          | 364681821  | productora  |
| 382 | cream_entertainment_group_spa                                          | 702702043  | productora  |
| 383 | eveerlast_productions_inc.                                             | 582665695  | productora  |
| 384 | 903                                                                    | 675347714  | productora  |
| 385 | dedalo_producciones                                                    | 87274815   | productora  |
| 386 | dreams_-_eventos                                                       | 656769530  | productora  |
| 387 | preludio_producciones_s.a._                                            | 258852526  | productora  |
| 388 | event_production_company                                               | 908895024  | productora  |
| 389 | tyg_eventos_y_producciones                                             | 146006316  | productora  |
| 390 | top_bruselas                                                           | 96687623   | productora  |
| 391 | palermo_films_s.a.                                                     | 826120571  | productora  |
| 392 | fmg_producciones                                                       | 21387809   | productora  |
| 393 | corral_y_asociados_limitada                                            | 121441998  | productora  |
| 394 | eventos_comunidad_ombligo_limitada                                     | 369078624  | productora  |
| 395 | ibolele_producciones                                                   | 518728495  | productora  |
| 396 | leading_event_agency                                                   | 488820690  | productora  |
| 397 | torres_petronas_spa                                                    | 861945534  | productora  |
| 398 | eventos_toronto_shaddai                                                | 976913944  | productora  |
| 399 | ye_y_ca_producciones                                                   | 621954131  | productora  |
| 400 | wlaceventos                                                            | 492586753  | productora  |
| 401 | bdd_producciones                                                       | 617226662  | productora  |
| 402 | global_producciones_spa                                                | 976291217  | productora  |
| 403 | producciones_baltimore                                                 | 812217676  | productora  |
| 404 | event_hire_sydney                                                      | 805479487  | productora  |
| 405 | eventos_y_producciones_evolucion_s.a                                   | 197829326  | productora  |
| 406 | as_relaciones_publicas                                                 | 7410136    | productora  |
| 407 | ee_-_servicio_de_eventos                                               | 98638265   | productora  |
| 408 | centro_eventos_torres_de_paine                                         | 910929379  | productora  |
| 409 | mouro_producciones                                                     | 174841180  | productora  |
| 410 | centro_de_convenciones_santiago_s.a.                                   | 736804718  | productora  |
| 411 | rot_entertainment                                                      | 921168738  | productora  |
| 412 | ais_producciones                                                       | 714740057  | productora  |
| 413 | carlos_lopez_vega_productora_de_eventos                                | 80044996   | productora  |
| 414 | chocolate_stage_s.a.                                                   | 656107783  | productora  |
| 415 | hispagenda                                                             | 895684933  | productora  |
| 416 | soc_giacaman_y_cia_ltda                                                | 506110921  | productora  |
| 417 | ethno_nueva_zelanda                                                    | 955363287  | productora  |
| 418 | medios_y_contenidos_producciones_                                      | 72576998   | productora  |
| 419 | atipica_                                                               | 395120523  | productora  |
| 420 | medios_y_contenidos_producciones_de_chile_s.a.                         | 561277879  | productora  |
| 421 | virtualia_(productora_de_eventos)                                      | 686649345  | productora  |
| 422 | ap_eventos                                                             | 20541837   | productora  |
| 423 | sociedad_comercial_mk_pro_limitada                                     | 880646851  | productora  |
| 424 | ramasso_productora                                                     | 92464495   | productora  |
| 425 | andeschimp_spa                                                         | 423654360  | productora  |
| 426 | estadium_luna_park                                                     | 268670734  | productora  |
| 427 | latitud_music_spa                                                      | 863801485  | productora  |
| 428 | comercial_audio_tec_limitada                                           | 151424870  | productora  |
| 429 | compania_argentina_de_suenos                                           | 196495041  | productora  |  