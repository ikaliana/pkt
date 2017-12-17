--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.9
-- Dumped by pg_dump version 9.5.5

-- Started on 2017-12-17 22:12:20

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 18 (class 2615 OID 18296)
-- Name: tiger; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA tiger;


ALTER SCHEMA tiger OWNER TO postgres;

--
-- TOC entry 19 (class 2615 OID 18566)
-- Name: tiger_data; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA tiger_data;


ALTER SCHEMA tiger_data OWNER TO postgres;

--
-- TOC entry 17 (class 2615 OID 18023)
-- Name: topology; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA topology;


ALTER SCHEMA topology OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 4211 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- TOC entry 9 (class 3079 OID 18165)
-- Name: address_standardizer; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS address_standardizer WITH SCHEMA public;


--
-- TOC entry 4212 (class 0 OID 0)
-- Dependencies: 9
-- Name: EXTENSION address_standardizer; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION address_standardizer IS 'Used to parse an address into constituent elements. Generally used to support geocoding address normalization step.';


--
-- TOC entry 4 (class 3079 OID 18285)
-- Name: fuzzystrmatch; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS fuzzystrmatch WITH SCHEMA public;


--
-- TOC entry 4213 (class 0 OID 0)
-- Dependencies: 4
-- Name: EXTENSION fuzzystrmatch; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION fuzzystrmatch IS 'determine similarities and distance between strings';


--
-- TOC entry 5 (class 3079 OID 18281)
-- Name: ogr_fdw; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS ogr_fdw WITH SCHEMA public;


--
-- TOC entry 4214 (class 0 OID 0)
-- Dependencies: 5
-- Name: EXTENSION ogr_fdw; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION ogr_fdw IS 'foreign-data wrapper for GIS data access';


--
-- TOC entry 11 (class 3079 OID 16395)
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- TOC entry 4215 (class 0 OID 0)
-- Dependencies: 11
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';


--
-- TOC entry 10 (class 3079 OID 17868)
-- Name: pgrouting; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pgrouting WITH SCHEMA public;


--
-- TOC entry 4216 (class 0 OID 0)
-- Dependencies: 10
-- Name: EXTENSION pgrouting; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgrouting IS 'pgRouting Extension';


--
-- TOC entry 7 (class 3079 OID 18190)
-- Name: pointcloud; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pointcloud WITH SCHEMA public;


--
-- TOC entry 4217 (class 0 OID 0)
-- Dependencies: 7
-- Name: EXTENSION pointcloud; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pointcloud IS 'data type for lidar point clouds';


--
-- TOC entry 6 (class 3079 OID 18273)
-- Name: pointcloud_postgis; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pointcloud_postgis WITH SCHEMA public;


--
-- TOC entry 4218 (class 0 OID 0)
-- Dependencies: 6
-- Name: EXTENSION pointcloud_postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pointcloud_postgis IS 'integration for pointcloud LIDAR data and PostGIS geometry data';


--
-- TOC entry 8 (class 3079 OID 18172)
-- Name: postgis_sfcgal; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_sfcgal WITH SCHEMA public;


--
-- TOC entry 4219 (class 0 OID 0)
-- Dependencies: 8
-- Name: EXTENSION postgis_sfcgal; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_sfcgal IS 'PostGIS SFCGAL functions';


--
-- TOC entry 3 (class 3079 OID 18297)
-- Name: postgis_tiger_geocoder; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_tiger_geocoder WITH SCHEMA tiger;


--
-- TOC entry 4220 (class 0 OID 0)
-- Dependencies: 3
-- Name: EXTENSION postgis_tiger_geocoder; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_tiger_geocoder IS 'PostGIS tiger geocoder and reverse geocoder';


--
-- TOC entry 2 (class 3079 OID 18024)
-- Name: postgis_topology; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_topology WITH SCHEMA topology;


--
-- TOC entry 4221 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION postgis_topology; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_topology IS 'PostGIS topology spatial types and functions';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 273 (class 1259 OID 18833)
-- Name: pkt_analisis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_analisis (
    kode_analisis integer NOT NULL,
    tanggal_analisis timestamp without time zone NOT NULL,
    kode_citra integer NOT NULL,
    kode_model_n integer NOT NULL,
    kode_model_p integer NOT NULL,
    kode_model_k integer NOT NULL,
    status boolean NOT NULL
);


ALTER TABLE pkt_analisis OWNER TO postgres;

--
-- TOC entry 274 (class 1259 OID 18836)
-- Name: pkt_analisis_kode_analisis_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pkt_analisis_kode_analisis_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pkt_analisis_kode_analisis_seq OWNER TO postgres;

--
-- TOC entry 4222 (class 0 OID 0)
-- Dependencies: 274
-- Name: pkt_analisis_kode_analisis_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_analisis_kode_analisis_seq OWNED BY pkt_analisis.kode_analisis;


--
-- TOC entry 275 (class 1259 OID 18838)
-- Name: pkt_area; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_area (
    nama character varying(2044) NOT NULL,
    lokasi character varying(2044) NOT NULL,
    deskripsi text NOT NULL,
    nama_file character varying(2044) NOT NULL,
    kode_area integer NOT NULL
);


ALTER TABLE pkt_area OWNER TO postgres;

--
-- TOC entry 284 (class 1259 OID 27034)
-- Name: pkt_area_kode_area_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pkt_area_kode_area_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pkt_area_kode_area_seq OWNER TO postgres;

--
-- TOC entry 4223 (class 0 OID 0)
-- Dependencies: 284
-- Name: pkt_area_kode_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_area_kode_area_seq OWNED BY pkt_area.kode_area;


--
-- TOC entry 276 (class 1259 OID 18846)
-- Name: pkt_citra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_citra (
    kode_citra integer NOT NULL,
    tanggal date NOT NULL,
    kode_area integer NOT NULL,
    nama_file character varying(255),
    download_status boolean
);


ALTER TABLE pkt_citra OWNER TO postgres;

--
-- TOC entry 277 (class 1259 OID 18852)
-- Name: pkt_citra_kode_citra_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pkt_citra_kode_citra_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pkt_citra_kode_citra_seq OWNER TO postgres;

--
-- TOC entry 4224 (class 0 OID 0)
-- Dependencies: 277
-- Name: pkt_citra_kode_citra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_citra_kode_citra_seq OWNED BY pkt_citra.kode_citra;


--
-- TOC entry 278 (class 1259 OID 18854)
-- Name: pkt_model; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_model (
    id_model integer NOT NULL,
    nama character varying(255) NOT NULL,
    nutrisi character varying(255) NOT NULL,
    band1 double precision,
    band2 double precision,
    band3 double precision,
    band4 double precision,
    band5 double precision,
    band6 double precision,
    band7 double precision,
    band8 double precision,
    band9 double precision,
    band10 double precision,
    band11 double precision,
    band12 double precision,
    band1_2 double precision,
    band2_2 double precision,
    band3_2 double precision,
    band4_2 double precision,
    band5_2 double precision,
    band6_2 double precision,
    band7_2 double precision,
    band8_2 double precision,
    band9_2 double precision,
    band10_2 double precision,
    band11_2 double precision,
    band12_2 double precision,
    band8a double precision,
    band8a_2 double precision
);


ALTER TABLE pkt_model OWNER TO postgres;

--
-- TOC entry 279 (class 1259 OID 18860)
-- Name: pkt_model_id_model_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pkt_model_id_model_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pkt_model_id_model_seq OWNER TO postgres;

--
-- TOC entry 4225 (class 0 OID 0)
-- Dependencies: 279
-- Name: pkt_model_id_model_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_model_id_model_seq OWNED BY pkt_model.id_model;


--
-- TOC entry 280 (class 1259 OID 18862)
-- Name: pkt_pupuk; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_pupuk (
    kode_pupuk integer NOT NULL,
    nama_pupuk character varying(2044) NOT NULL,
    komposisi_n numeric NOT NULL,
    komposisi_p numeric NOT NULL,
    komposisi_k numeric NOT NULL
);


ALTER TABLE pkt_pupuk OWNER TO postgres;

--
-- TOC entry 281 (class 1259 OID 18868)
-- Name: pkt_pupuk_kode_pupuk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pkt_pupuk_kode_pupuk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pkt_pupuk_kode_pupuk_seq OWNER TO postgres;

--
-- TOC entry 4226 (class 0 OID 0)
-- Dependencies: 281
-- Name: pkt_pupuk_kode_pupuk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_pupuk_kode_pupuk_seq OWNED BY pkt_pupuk.kode_pupuk;


--
-- TOC entry 283 (class 1259 OID 18922)
-- Name: pkt_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_user (
    user_id bigint NOT NULL,
    username character varying(16),
    login_pass character varying(32),
    level integer
);


ALTER TABLE pkt_user OWNER TO postgres;

--
-- TOC entry 282 (class 1259 OID 18920)
-- Name: pkt_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pkt_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pkt_user_user_id_seq OWNER TO postgres;

--
-- TOC entry 4227 (class 0 OID 0)
-- Dependencies: 282
-- Name: pkt_user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_user_user_id_seq OWNED BY pkt_user.user_id;


--
-- TOC entry 272 (class 1259 OID 18822)
-- Name: seq_modelregresi; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE seq_modelregresi
    START WITH 3
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seq_modelregresi OWNER TO postgres;

--
-- TOC entry 4040 (class 2604 OID 18870)
-- Name: kode_analisis; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis ALTER COLUMN kode_analisis SET DEFAULT nextval('pkt_analisis_kode_analisis_seq'::regclass);


--
-- TOC entry 4041 (class 2604 OID 27036)
-- Name: kode_area; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area ALTER COLUMN kode_area SET DEFAULT nextval('pkt_area_kode_area_seq'::regclass);


--
-- TOC entry 4042 (class 2604 OID 18872)
-- Name: kode_citra; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra ALTER COLUMN kode_citra SET DEFAULT nextval('pkt_citra_kode_citra_seq'::regclass);


--
-- TOC entry 4043 (class 2604 OID 18873)
-- Name: id_model; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model ALTER COLUMN id_model SET DEFAULT nextval('pkt_model_id_model_seq'::regclass);


--
-- TOC entry 4044 (class 2604 OID 18874)
-- Name: kode_pupuk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk ALTER COLUMN kode_pupuk SET DEFAULT nextval('pkt_pupuk_kode_pupuk_seq'::regclass);


--
-- TOC entry 4045 (class 2604 OID 18925)
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_user ALTER COLUMN user_id SET DEFAULT nextval('pkt_user_user_id_seq'::regclass);


--
-- TOC entry 4192 (class 0 OID 18833)
-- Dependencies: 273
-- Data for Name: pkt_analisis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_analisis (kode_analisis, tanggal_analisis, kode_citra, kode_model_n, kode_model_p, kode_model_k, status) FROM stdin;
2	2017-09-03 13:45:00	2	2	2	2	f
1	2017-08-01 17:00:00	1	1	2	2	f
3	2017-09-03 14:32:00	3	2	2	2	f
\.


--
-- TOC entry 4228 (class 0 OID 0)
-- Dependencies: 274
-- Name: pkt_analisis_kode_analisis_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_analisis_kode_analisis_seq', 1, false);


--
-- TOC entry 4194 (class 0 OID 18838)
-- Dependencies: 275
-- Data for Name: pkt_area; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_area (nama, lokasi, deskripsi, nama_file, kode_area) FROM stdin;
PTPN VI Afd 3 Blok 320	Jambi	deskripsinya	area_2	2
PTPN VI Afd 2 Blok 210	Jambi	deskripsinya	area_3	3
\.


--
-- TOC entry 4229 (class 0 OID 0)
-- Dependencies: 284
-- Name: pkt_area_kode_area_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_area_kode_area_seq', 46, true);


--
-- TOC entry 4195 (class 0 OID 18846)
-- Dependencies: 276
-- Data for Name: pkt_citra; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_citra (kode_citra, tanggal, kode_area, nama_file, download_status) FROM stdin;
1	2017-05-25	1	citra_1	f
3	2017-08-22	3	citra_3	f
14	2017-12-07	3	img001	f
15	2017-12-22	2	logo	f
16	2017-12-24	3	logo	f
\.


--
-- TOC entry 4230 (class 0 OID 0)
-- Dependencies: 277
-- Name: pkt_citra_kode_citra_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_citra_kode_citra_seq', 17, true);


--
-- TOC entry 4197 (class 0 OID 18854)
-- Dependencies: 278
-- Data for Name: pkt_model; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_model (id_model, nama, nutrisi, band1, band2, band3, band4, band5, band6, band7, band8, band9, band10, band11, band12, band1_2, band2_2, band3_2, band4_2, band5_2, band6_2, band7_2, band8_2, band9_2, band10_2, band11_2, band12_2, band8a, band8a_2) FROM stdin;
2	Model P Daun Jonggol	P	0.00040488991643162299	-0.00088293741581122495	0	0	0	0	0	0	-0.00192815931459484	0	0	0	0	0	0	0	0	9.2801867882504801e-008	0	-1.6761786521430399e-007	0	0	0	0	0	8.4473628235450496e-008
1	Model N Daun Jonggol	N	-0.0090426824497838194	0	0	0.033951518981873603	0.050605693701307602	0	-0.0016409590285455401	0	-0.14617210906752401	-0.34500990786065799	0.0030827900793604598	0	0	0	8.6570537143428003e-006	-1.84787179932601e-005	-2.8291029061975602e-005	-1.0006999792628001e-006	3.7975298242866999e-007	4.2944822276076098e-007	0.00015371529397908	0.0020147621716899598	0	-5.3088491682898e-006	0	0
\.


--
-- TOC entry 4231 (class 0 OID 0)
-- Dependencies: 279
-- Name: pkt_model_id_model_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_model_id_model_seq', 2, true);


--
-- TOC entry 4199 (class 0 OID 18862)
-- Dependencies: 280
-- Data for Name: pkt_pupuk; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_pupuk (kode_pupuk, nama_pupuk, komposisi_n, komposisi_p, komposisi_k) FROM stdin;
1	Urea	45	0	0
2	NPK	15	15	15
3	NPK 2	10	10	10
\.


--
-- TOC entry 4232 (class 0 OID 0)
-- Dependencies: 281
-- Name: pkt_pupuk_kode_pupuk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_pupuk_kode_pupuk_seq', 1, false);


--
-- TOC entry 4202 (class 0 OID 18922)
-- Dependencies: 283
-- Data for Name: pkt_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_user (user_id, username, login_pass, level) FROM stdin;
1	admin	21232f297a57a5a743894a0e4a801fc3	1
\.


--
-- TOC entry 4233 (class 0 OID 0)
-- Dependencies: 282
-- Name: pkt_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_user_user_id_seq', 1, false);


--
-- TOC entry 4038 (class 0 OID 18192)
-- Dependencies: 220
-- Data for Name: pointcloud_formats; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pointcloud_formats  FROM stdin;
\.


--
-- TOC entry 4234 (class 0 OID 0)
-- Dependencies: 272
-- Name: seq_modelregresi; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('seq_modelregresi', 3, false);


--
-- TOC entry 4039 (class 0 OID 16692)
-- Dependencies: 195
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY spatial_ref_sys  FROM stdin;
\.


SET search_path = tiger, pg_catalog;

--
-- TOC entry 4034 (class 0 OID 18303)
-- Dependencies: 223
-- Data for Name: geocode_settings; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY geocode_settings  FROM stdin;
\.


--
-- TOC entry 4035 (class 0 OID 18658)
-- Dependencies: 267
-- Data for Name: pagc_gaz; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY pagc_gaz  FROM stdin;
\.


--
-- TOC entry 4036 (class 0 OID 18670)
-- Dependencies: 269
-- Data for Name: pagc_lex; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY pagc_lex  FROM stdin;
\.


--
-- TOC entry 4037 (class 0 OID 18682)
-- Dependencies: 271
-- Data for Name: pagc_rules; Type: TABLE DATA; Schema: tiger; Owner: postgres
--

COPY pagc_rules  FROM stdin;
\.


SET search_path = topology, pg_catalog;

--
-- TOC entry 4032 (class 0 OID 18027)
-- Dependencies: 214
-- Data for Name: topology; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology  FROM stdin;
\.


--
-- TOC entry 4033 (class 0 OID 18040)
-- Dependencies: 215
-- Data for Name: layer; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY layer  FROM stdin;
\.


SET search_path = public, pg_catalog;

--
-- TOC entry 4051 (class 2606 OID 27044)
-- Name: PK; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area
    ADD CONSTRAINT "PK" PRIMARY KEY (kode_area);


--
-- TOC entry 4047 (class 2606 OID 18876)
-- Name: pkt_analisis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT pkt_analisis_pkey PRIMARY KEY (kode_analisis);


--
-- TOC entry 4053 (class 2606 OID 18880)
-- Name: pkt_citra_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT pkt_citra_pkey PRIMARY KEY (kode_citra);


--
-- TOC entry 4057 (class 2606 OID 18882)
-- Name: pkt_model_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model
    ADD CONSTRAINT pkt_model_pkey PRIMARY KEY (id_model);


--
-- TOC entry 4061 (class 2606 OID 18884)
-- Name: pkt_pupuk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk
    ADD CONSTRAINT pkt_pupuk_pkey PRIMARY KEY (kode_pupuk);


--
-- TOC entry 4065 (class 2606 OID 18927)
-- Name: primary key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_user
    ADD CONSTRAINT "primary key" PRIMARY KEY (user_id);


--
-- TOC entry 4059 (class 2606 OID 18886)
-- Name: unique_id_model; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model
    ADD CONSTRAINT unique_id_model UNIQUE (id_model);


--
-- TOC entry 4049 (class 2606 OID 18888)
-- Name: unique_kode_analisis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT unique_kode_analisis UNIQUE (kode_analisis);


--
-- TOC entry 4055 (class 2606 OID 18892)
-- Name: unique_kode_citra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT unique_kode_citra UNIQUE (kode_citra);


--
-- TOC entry 4063 (class 2606 OID 18894)
-- Name: unique_kode_pupuk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk
    ADD CONSTRAINT unique_kode_pupuk UNIQUE (kode_pupuk);


--
-- TOC entry 4068 (class 2606 OID 18905)
-- Name: kode_model_k; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_k FOREIGN KEY (kode_model_k) REFERENCES pkt_model(id_model);


--
-- TOC entry 4067 (class 2606 OID 18910)
-- Name: kode_model_n; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_n FOREIGN KEY (kode_model_n) REFERENCES pkt_model(id_model);


--
-- TOC entry 4066 (class 2606 OID 18915)
-- Name: kode_model_p; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_p FOREIGN KEY (kode_model_p) REFERENCES pkt_model(id_model);


--
-- TOC entry 4210 (class 0 OID 0)
-- Dependencies: 20
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-12-17 22:12:24

--
-- PostgreSQL database dump complete
--

