PGDMP                      |            ops-praktek    17.2    17.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            �           1262    16387    ops-praktek    DATABASE     �   CREATE DATABASE "ops-praktek" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE "ops-praktek";
                     postgres    false            �            1259    16389    login    TABLE     �   CREATE TABLE public.login (
    id integer NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(255) NOT NULL
);
    DROP TABLE public.login;
       public         heap r       postgres    false            �            1259    16388    login_id_seq    SEQUENCE     �   CREATE SEQUENCE public.login_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.login_id_seq;
       public               postgres    false    218            �           0    0    login_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.login_id_seq OWNED BY public.login.id;
          public               postgres    false    217            �            1259    16408    products    TABLE     �  CREATE TABLE public.products (
    id_product integer NOT NULL,
    nama_produk character varying(100) NOT NULL,
    kategori_produk character varying(50) NOT NULL,
    harga_barang numeric(10,2) NOT NULL,
    harga_jual numeric(10,2) NOT NULL,
    image character varying(255),
    stok_produk integer DEFAULT 0 NOT NULL,
    CONSTRAINT products_kategori_produk_check CHECK (((kategori_produk)::text = ANY ((ARRAY['alat olahraga'::character varying, 'alat musik'::character varying])::text[])))
);
    DROP TABLE public.products;
       public         heap r       postgres    false            �            1259    16407    products_id_product_seq    SEQUENCE     �   CREATE SEQUENCE public.products_id_product_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.products_id_product_seq;
       public               postgres    false    222            �           0    0    products_id_product_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.products_id_product_seq OWNED BY public.products.id_product;
          public               postgres    false    221            �            1259    16398    users    TABLE     �   CREATE TABLE public.users (
    id_user integer NOT NULL,
    email character varying(50) NOT NULL,
    password character varying(255) NOT NULL
);
    DROP TABLE public.users;
       public         heap r       postgres    false            �            1259    16397    users_id_user_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.users_id_user_seq;
       public               postgres    false    220            �           0    0    users_id_user_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.users_id_user_seq OWNED BY public.users.id_user;
          public               postgres    false    219            +           2604    16392    login id    DEFAULT     d   ALTER TABLE ONLY public.login ALTER COLUMN id SET DEFAULT nextval('public.login_id_seq'::regclass);
 7   ALTER TABLE public.login ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    217    218    218            -           2604    16411    products id_product    DEFAULT     z   ALTER TABLE ONLY public.products ALTER COLUMN id_product SET DEFAULT nextval('public.products_id_product_seq'::regclass);
 B   ALTER TABLE public.products ALTER COLUMN id_product DROP DEFAULT;
       public               postgres    false    221    222    222            ,           2604    16401    users id_user    DEFAULT     n   ALTER TABLE ONLY public.users ALTER COLUMN id_user SET DEFAULT nextval('public.users_id_user_seq'::regclass);
 <   ALTER TABLE public.users ALTER COLUMN id_user DROP DEFAULT;
       public               postgres    false    220    219    220            �          0    16389    login 
   TABLE DATA           4   COPY public.login (id, email, password) FROM stdin;
    public               postgres    false    218          �          0    16408    products 
   TABLE DATA           z   COPY public.products (id_product, nama_produk, kategori_produk, harga_barang, harga_jual, image, stok_produk) FROM stdin;
    public               postgres    false    222   E       �          0    16398    users 
   TABLE DATA           9   COPY public.users (id_user, email, password) FROM stdin;
    public               postgres    false    220   �       �           0    0    login_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.login_id_seq', 1, true);
          public               postgres    false    217            �           0    0    products_id_product_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.products_id_product_seq', 2, true);
          public               postgres    false    221            �           0    0    users_id_user_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.users_id_user_seq', 5, true);
          public               postgres    false    219            1           2606    16396    login login_email_key 
   CONSTRAINT     Q   ALTER TABLE ONLY public.login
    ADD CONSTRAINT login_email_key UNIQUE (email);
 ?   ALTER TABLE ONLY public.login DROP CONSTRAINT login_email_key;
       public                 postgres    false    218            3           2606    16394    login login_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.login
    ADD CONSTRAINT login_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.login DROP CONSTRAINT login_pkey;
       public                 postgres    false    218            9           2606    16414    products products_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id_product);
 @   ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
       public                 postgres    false    222            5           2606    16403    users users_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public                 postgres    false    220            7           2606    16405    users users_username_key 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_key;
       public                 postgres    false    220            �   3   x�3�,N-��O,�LM�KOO,J446tH�M���K���LL�������� M��      �   \   x�=�A
�  ���
_ �.f]{B� V4�J#�?ѥ9�$Gjz�x���rJ����,��c����uD�I+�~`L���<s���l�R/&�      �   @   x�3�,N-��O,�LM�KOO,J446�K�M���K���LL����2��r@7���`H��qqq ��     