--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.1
-- Dumped by pg_dump version 9.5.1

-- Started on 2018-12-16 08:01:17

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 271 (class 1259 OID 80223)
-- Name: pkt_analisis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_analisis (
    kode_analisis integer NOT NULL,
    tanggal_analisis timestamp without time zone NOT NULL,
    kode_citra integer NOT NULL,
    kode_model_n integer NOT NULL,
    kode_model_p integer NOT NULL,
    kode_model_k integer NOT NULL,
    status boolean NOT NULL,
    kode_model_n_tanah integer NOT NULL,
    kode_model_p_tanah integer NOT NULL,
    kode_model_k_tanah integer NOT NULL,
    kode_model_mg integer DEFAULT 0 NOT NULL
);


ALTER TABLE pkt_analisis OWNER TO postgres;

--
-- TOC entry 285 (class 1259 OID 80341)
-- Name: pkt_analisis_detail; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_analisis_detail (
    kode_analisis integer,
    kode_pupuk integer,
    nama_pupuk character varying(2044),
    nama_unsur character varying(50),
    dosis_total double precision,
    dosis_hektar double precision,
    dosis_pohon double precision,
    jenis_pupuk character varying(50)
);


ALTER TABLE pkt_analisis_detail OWNER TO postgres;

--
-- TOC entry 4007 (class 0 OID 0)
-- Dependencies: 285
-- Name: COLUMN pkt_analisis_detail.jenis_pupuk; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN pkt_analisis_detail.jenis_pupuk IS 'TUNGGAL / MAJEMUK';


--
-- TOC entry 272 (class 1259 OID 80226)
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
-- TOC entry 4008 (class 0 OID 0)
-- Dependencies: 272
-- Name: pkt_analisis_kode_analisis_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_analisis_kode_analisis_seq OWNED BY pkt_analisis.kode_analisis;


--
-- TOC entry 284 (class 1259 OID 80335)
-- Name: pkt_analisis_summary; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_analisis_summary (
    kode_analisis integer NOT NULL,
    last_process timestamp without time zone,
    status_process character varying(50),
    err_message text,
    luas_area double precision
);


ALTER TABLE pkt_analisis_summary OWNER TO postgres;

--
-- TOC entry 4009 (class 0 OID 0)
-- Dependencies: 284
-- Name: COLUMN pkt_analisis_summary.status_process; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN pkt_analisis_summary.status_process IS 'value: OK /  ERROR';


--
-- TOC entry 273 (class 1259 OID 80240)
-- Name: pkt_area; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_area (
    kode_area integer NOT NULL,
    nama character varying(2044) NOT NULL,
    lokasi character varying(2044) NOT NULL,
    deskripsi text NOT NULL,
    nama_file character varying(2044) NOT NULL
);


ALTER TABLE pkt_area OWNER TO postgres;

--
-- TOC entry 274 (class 1259 OID 80246)
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
-- TOC entry 4010 (class 0 OID 0)
-- Dependencies: 274
-- Name: pkt_area_kode_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_area_kode_area_seq OWNED BY pkt_area.kode_area;


--
-- TOC entry 275 (class 1259 OID 80248)
-- Name: pkt_citra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_citra (
    kode_citra integer NOT NULL,
    tanggal date NOT NULL,
    kode_area integer NOT NULL,
    nama_file character varying(255)
);


ALTER TABLE pkt_citra OWNER TO postgres;

--
-- TOC entry 276 (class 1259 OID 80251)
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
-- TOC entry 4011 (class 0 OID 0)
-- Dependencies: 276
-- Name: pkt_citra_kode_citra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_citra_kode_citra_seq OWNED BY pkt_citra.kode_citra;


--
-- TOC entry 277 (class 1259 OID 80253)
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
    band8a_2 double precision,
    constant double precision
);


ALTER TABLE pkt_model OWNER TO postgres;

--
-- TOC entry 278 (class 1259 OID 80259)
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
-- TOC entry 4012 (class 0 OID 0)
-- Dependencies: 278
-- Name: pkt_model_id_model_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_model_id_model_seq OWNED BY pkt_model.id_model;


--
-- TOC entry 279 (class 1259 OID 80261)
-- Name: pkt_pupuk; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_pupuk (
    kode_pupuk integer NOT NULL,
    nama_pupuk character varying(2044) NOT NULL,
    komposisi_n numeric NOT NULL,
    komposisi_p numeric NOT NULL,
    komposisi_k numeric NOT NULL,
    komposisi_mg numeric DEFAULT 0 NOT NULL
);


ALTER TABLE pkt_pupuk OWNER TO postgres;

--
-- TOC entry 280 (class 1259 OID 80267)
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
-- TOC entry 4013 (class 0 OID 0)
-- Dependencies: 280
-- Name: pkt_pupuk_kode_pupuk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_pupuk_kode_pupuk_seq OWNED BY pkt_pupuk.kode_pupuk;


--
-- TOC entry 286 (class 1259 OID 80347)
-- Name: pkt_rekomendasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_rekomendasi (
    kode_pupuk integer,
    umur_tanaman integer,
    jumlah_pupuk double precision
);


ALTER TABLE pkt_rekomendasi OWNER TO postgres;

--
-- TOC entry 287 (class 1259 OID 88554)
-- Name: pkt_riwayat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_riwayat (
    kode_riwayat numeric DEFAULT nextval('pkt_riwayat_kode_riwayat_seq'::regclass) NOT NULL,
    kode_area integer NOT NULL,
    tahun integer,
    dosis_pupuk double precision,
    kode_pupuk integer NOT NULL
);


ALTER TABLE pkt_riwayat OWNER TO postgres;

--
-- TOC entry 281 (class 1259 OID 80269)
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
-- TOC entry 282 (class 1259 OID 80272)
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
-- TOC entry 4014 (class 0 OID 0)
-- Dependencies: 282
-- Name: pkt_user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_user_user_id_seq OWNED BY pkt_user.user_id;


--
-- TOC entry 3841 (class 2604 OID 80276)
-- Name: kode_analisis; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis ALTER COLUMN kode_analisis SET DEFAULT nextval('pkt_analisis_kode_analisis_seq'::regclass);


--
-- TOC entry 3843 (class 2604 OID 80277)
-- Name: kode_area; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area ALTER COLUMN kode_area SET DEFAULT nextval('pkt_area_kode_area_seq'::regclass);


--
-- TOC entry 3844 (class 2604 OID 80278)
-- Name: kode_citra; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra ALTER COLUMN kode_citra SET DEFAULT nextval('pkt_citra_kode_citra_seq'::regclass);


--
-- TOC entry 3845 (class 2604 OID 80279)
-- Name: id_model; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model ALTER COLUMN id_model SET DEFAULT nextval('pkt_model_id_model_seq'::regclass);


--
-- TOC entry 3846 (class 2604 OID 80280)
-- Name: kode_pupuk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk ALTER COLUMN kode_pupuk SET DEFAULT nextval('pkt_pupuk_kode_pupuk_seq'::regclass);


--
-- TOC entry 3848 (class 2604 OID 80281)
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_user ALTER COLUMN user_id SET DEFAULT nextval('pkt_user_user_id_seq'::regclass);


--
-- TOC entry 3851 (class 2606 OID 80283)
-- Name: pkt_analisis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT pkt_analisis_pkey PRIMARY KEY (kode_analisis);


--
-- TOC entry 3855 (class 2606 OID 80285)
-- Name: pkt_area_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area
    ADD CONSTRAINT pkt_area_pkey PRIMARY KEY (kode_area);


--
-- TOC entry 3859 (class 2606 OID 80287)
-- Name: pkt_citra_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT pkt_citra_pkey PRIMARY KEY (kode_citra);


--
-- TOC entry 3863 (class 2606 OID 80289)
-- Name: pkt_model_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model
    ADD CONSTRAINT pkt_model_pkey PRIMARY KEY (id_model);


--
-- TOC entry 3867 (class 2606 OID 80291)
-- Name: pkt_pupuk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk
    ADD CONSTRAINT pkt_pupuk_pkey PRIMARY KEY (kode_pupuk);


--
-- TOC entry 3873 (class 2606 OID 88561)
-- Name: pkt_riwayat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_riwayat
    ADD CONSTRAINT pkt_riwayat_pkey PRIMARY KEY (kode_riwayat);


--
-- TOC entry 3871 (class 2606 OID 80293)
-- Name: primary key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_user
    ADD CONSTRAINT "primary key" PRIMARY KEY (user_id);


--
-- TOC entry 3865 (class 2606 OID 80295)
-- Name: unique_id_model; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model
    ADD CONSTRAINT unique_id_model UNIQUE (id_model);


--
-- TOC entry 3853 (class 2606 OID 80297)
-- Name: unique_kode_analisis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT unique_kode_analisis UNIQUE (kode_analisis);


--
-- TOC entry 3857 (class 2606 OID 80299)
-- Name: unique_kode_area; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area
    ADD CONSTRAINT unique_kode_area UNIQUE (kode_area);


--
-- TOC entry 3861 (class 2606 OID 80301)
-- Name: unique_kode_citra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT unique_kode_citra UNIQUE (kode_citra);


--
-- TOC entry 3869 (class 2606 OID 80303)
-- Name: unique_kode_pupuk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk
    ADD CONSTRAINT unique_kode_pupuk UNIQUE (kode_pupuk);


--
-- TOC entry 3878 (class 2606 OID 80304)
-- Name: kode_area; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT kode_area FOREIGN KEY (kode_area) REFERENCES pkt_area(kode_area);


--
-- TOC entry 3877 (class 2606 OID 80309)
-- Name: kode_citra; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_citra FOREIGN KEY (kode_citra) REFERENCES pkt_citra(kode_citra);


--
-- TOC entry 3876 (class 2606 OID 80314)
-- Name: kode_model_k; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_k FOREIGN KEY (kode_model_k) REFERENCES pkt_model(id_model);


--
-- TOC entry 3875 (class 2606 OID 80319)
-- Name: kode_model_n; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_n FOREIGN KEY (kode_model_n) REFERENCES pkt_model(id_model);


--
-- TOC entry 3874 (class 2606 OID 80324)
-- Name: kode_model_p; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_p FOREIGN KEY (kode_model_p) REFERENCES pkt_model(id_model);


--
-- TOC entry 3880 (class 2606 OID 88562)
-- Name: pkt_area_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_riwayat
    ADD CONSTRAINT pkt_area_fkey FOREIGN KEY (kode_area) REFERENCES pkt_area(kode_area);


--
-- TOC entry 3879 (class 2606 OID 88570)
-- Name: pkt_pupuk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_riwayat
    ADD CONSTRAINT pkt_pupuk_fkey FOREIGN KEY (kode_pupuk) REFERENCES pkt_pupuk(kode_pupuk);


-- Completed on 2018-12-16 08:01:18

--
-- PostgreSQL database dump complete
--

