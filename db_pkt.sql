--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.5
-- Dumped by pg_dump version 9.6.5

-- Started on 2017-10-12 15:27:46

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 194 (class 1259 OID 16440)
-- Name: pkt_analisis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_analisis (
    kode_analisis integer NOT NULL,
    tanggal_analisis date NOT NULL,
    kode_citra integer NOT NULL,
    kode_model_n integer NOT NULL,
    kode_model_p integer NOT NULL,
    kode_model_k integer NOT NULL,
    status boolean NOT NULL
);


ALTER TABLE pkt_analisis OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 16438)
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
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 193
-- Name: pkt_analisis_kode_analisis_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_analisis_kode_analisis_seq OWNED BY pkt_analisis.kode_analisis;


--
-- TOC entry 188 (class 1259 OID 16407)
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
-- TOC entry 187 (class 1259 OID 16405)
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
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 187
-- Name: pkt_area_kode_area_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_area_kode_area_seq OWNED BY pkt_area.kode_area;


--
-- TOC entry 190 (class 1259 OID 16418)
-- Name: pkt_citra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_citra (
    kode_citra integer NOT NULL,
    tanggal date NOT NULL,
    kode_area integer NOT NULL,
    nama_file numeric NOT NULL
);


ALTER TABLE pkt_citra OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 16416)
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
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 189
-- Name: pkt_citra_kode_citra_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_citra_kode_citra_seq OWNED BY pkt_citra.kode_citra;


--
-- TOC entry 186 (class 1259 OID 16396)
-- Name: pkt_model; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pkt_model (
    id_model integer NOT NULL,
    nama character varying(2044) NOT NULL,
    nutrisi character varying(2044) NOT NULL,
    band01 numeric NOT NULL,
    band02 numeric NOT NULL,
    band03 numeric NOT NULL,
    band04 numeric NOT NULL,
    band05 numeric NOT NULL,
    band06 numeric NOT NULL,
    band07 numeric NOT NULL,
    band08 numeric NOT NULL,
    band09 numeric NOT NULL,
    band10 numeric NOT NULL,
    band11 numeric NOT NULL,
    band12 numeric NOT NULL,
    band8a numeric NOT NULL
);


ALTER TABLE pkt_model OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 16394)
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
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 185
-- Name: pkt_model_id_model_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_model_id_model_seq OWNED BY pkt_model.id_model;


--
-- TOC entry 192 (class 1259 OID 16429)
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
-- TOC entry 191 (class 1259 OID 16427)
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
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 191
-- Name: pkt_pupuk_kode_pupuk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pkt_pupuk_kode_pupuk_seq OWNED BY pkt_pupuk.kode_pupuk;


--
-- TOC entry 2033 (class 2604 OID 16443)
-- Name: pkt_analisis kode_analisis; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis ALTER COLUMN kode_analisis SET DEFAULT nextval('pkt_analisis_kode_analisis_seq'::regclass);


--
-- TOC entry 2030 (class 2604 OID 16410)
-- Name: pkt_area kode_area; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area ALTER COLUMN kode_area SET DEFAULT nextval('pkt_area_kode_area_seq'::regclass);


--
-- TOC entry 2031 (class 2604 OID 16421)
-- Name: pkt_citra kode_citra; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra ALTER COLUMN kode_citra SET DEFAULT nextval('pkt_citra_kode_citra_seq'::regclass);


--
-- TOC entry 2029 (class 2604 OID 16399)
-- Name: pkt_model id_model; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model ALTER COLUMN id_model SET DEFAULT nextval('pkt_model_id_model_seq'::regclass);


--
-- TOC entry 2032 (class 2604 OID 16432)
-- Name: pkt_pupuk kode_pupuk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk ALTER COLUMN kode_pupuk SET DEFAULT nextval('pkt_pupuk_kode_pupuk_seq'::regclass);


--
-- TOC entry 2185 (class 0 OID 16440)
-- Dependencies: 194
-- Data for Name: pkt_analisis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_analisis (kode_analisis, tanggal_analisis, kode_citra, kode_model_n, kode_model_p, kode_model_k, status) FROM stdin;
\.


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 193
-- Name: pkt_analisis_kode_analisis_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_analisis_kode_analisis_seq', 1, false);


--
-- TOC entry 2179 (class 0 OID 16407)
-- Dependencies: 188
-- Data for Name: pkt_area; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_area (kode_area, nama, lokasi, deskripsi, nama_file) FROM stdin;
\.


--
-- TOC entry 2199 (class 0 OID 0)
-- Dependencies: 187
-- Name: pkt_area_kode_area_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_area_kode_area_seq', 1, false);


--
-- TOC entry 2181 (class 0 OID 16418)
-- Dependencies: 190
-- Data for Name: pkt_citra; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_citra (kode_citra, tanggal, kode_area, nama_file) FROM stdin;
\.


--
-- TOC entry 2200 (class 0 OID 0)
-- Dependencies: 189
-- Name: pkt_citra_kode_citra_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_citra_kode_citra_seq', 1, false);


--
-- TOC entry 2177 (class 0 OID 16396)
-- Dependencies: 186
-- Data for Name: pkt_model; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_model (id_model, nama, nutrisi, band01, band02, band03, band04, band05, band06, band07, band08, band09, band10, band11, band12, band8a) FROM stdin;
\.


--
-- TOC entry 2201 (class 0 OID 0)
-- Dependencies: 185
-- Name: pkt_model_id_model_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_model_id_model_seq', 1, false);


--
-- TOC entry 2183 (class 0 OID 16429)
-- Dependencies: 192
-- Data for Name: pkt_pupuk; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pkt_pupuk (kode_pupuk, nama_pupuk, komposisi_n, komposisi_p, komposisi_k) FROM stdin;
\.


--
-- TOC entry 2202 (class 0 OID 0)
-- Dependencies: 191
-- Name: pkt_pupuk_kode_pupuk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pkt_pupuk_kode_pupuk_seq', 1, false);


--
-- TOC entry 2051 (class 2606 OID 16454)
-- Name: pkt_analisis pkt_analisis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT pkt_analisis_pkey PRIMARY KEY (kode_analisis);


--
-- TOC entry 2039 (class 2606 OID 16456)
-- Name: pkt_area pkt_area_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area
    ADD CONSTRAINT pkt_area_pkey PRIMARY KEY (kode_area);


--
-- TOC entry 2043 (class 2606 OID 16458)
-- Name: pkt_citra pkt_citra_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT pkt_citra_pkey PRIMARY KEY (kode_citra);


--
-- TOC entry 2035 (class 2606 OID 16460)
-- Name: pkt_model pkt_model_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model
    ADD CONSTRAINT pkt_model_pkey PRIMARY KEY (id_model);


--
-- TOC entry 2047 (class 2606 OID 16462)
-- Name: pkt_pupuk pkt_pupuk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk
    ADD CONSTRAINT pkt_pupuk_pkey PRIMARY KEY (kode_pupuk);


--
-- TOC entry 2037 (class 2606 OID 16404)
-- Name: pkt_model unique_id_model; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_model
    ADD CONSTRAINT unique_id_model UNIQUE (id_model);


--
-- TOC entry 2053 (class 2606 OID 16448)
-- Name: pkt_analisis unique_kode_analisis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT unique_kode_analisis UNIQUE (kode_analisis);


--
-- TOC entry 2041 (class 2606 OID 16415)
-- Name: pkt_area unique_kode_area; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_area
    ADD CONSTRAINT unique_kode_area UNIQUE (kode_area);


--
-- TOC entry 2045 (class 2606 OID 16426)
-- Name: pkt_citra unique_kode_citra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT unique_kode_citra UNIQUE (kode_citra);


--
-- TOC entry 2049 (class 2606 OID 16437)
-- Name: pkt_pupuk unique_kode_pupuk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_pupuk
    ADD CONSTRAINT unique_kode_pupuk UNIQUE (kode_pupuk);


--
-- TOC entry 2054 (class 2606 OID 16471)
-- Name: pkt_citra kode_area; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_citra
    ADD CONSTRAINT kode_area FOREIGN KEY (kode_area) REFERENCES pkt_area(kode_area);


--
-- TOC entry 2055 (class 2606 OID 16485)
-- Name: pkt_analisis kode_citra; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_citra FOREIGN KEY (kode_citra) REFERENCES pkt_citra(kode_citra);


--
-- TOC entry 2058 (class 2606 OID 16521)
-- Name: pkt_analisis kode_model_k; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_k FOREIGN KEY (kode_model_k) REFERENCES pkt_model(id_model);


--
-- TOC entry 2056 (class 2606 OID 16511)
-- Name: pkt_analisis kode_model_n; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_n FOREIGN KEY (kode_model_n) REFERENCES pkt_model(id_model);


--
-- TOC entry 2057 (class 2606 OID 16516)
-- Name: pkt_analisis kode_model_p; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pkt_analisis
    ADD CONSTRAINT kode_model_p FOREIGN KEY (kode_model_p) REFERENCES pkt_model(id_model);


-- Completed on 2017-10-12 15:27:46

--
-- PostgreSQL database dump complete
--

