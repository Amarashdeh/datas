#! /usr/bin/perl

$now = time();

if ($ARGV[0] =~ /^--voteengine$/) {
    my(%v, $maxp);
    while (<DATA>) {
	if (/^(\d+)\s+(\d+)~r\s+(\d+)$/) {
	    $v{$2} = [] if !$v{$2};
	    $v{$2}->[$3] = [] if !$v{$2}->[$3];
	    push @{$v{$2}->[$3]}, $1;
	    $maxp = $1 if !$maxp || $1 > $maxp;
	}
    }
    print "-m schulze -cands 1-$maxp\n";
    foreach $vx (values(%v)) {
	for ($i = 0; $i < @$vx; ++$i) {
	    if ($vx->[$i]) {
		print join(" = ", @{$vx->[$i]}), " ";
	    }
	}
	print "\n";
    }
    exit 0;
}

print "insert into ContactInfo (contactId, firstName, lastName, email, password, collaborators, creationTime, roles) values (1, 'Janette', 'Chair', 'chair\@_.com', 'x', 'None', $now, 7) on duplicate key update email=email;\n";
print "insert into PCMember (contactId) values (1) on duplicate key update contactId=contactId;\n";
print "insert into Chair (contactId) values (1) on duplicate key update contactId=contactId;\n";

print "insert into Settings (name, value, data) values ('rev_open', $now, null), ('tag_rank', 1, 'r') on duplicate key update value=values(value), data=values(data);\n";

for ($i = 2; $i <= 30; ++$i) {
    print "insert into ContactInfo (contactId, firstName, lastName, email, password, collaborators, creationTime, roles) values ($i, 'Jody', 'Comm$i', 'comm$i\@_.com', 'x', 'None', $now, 1) on duplicate key update firstName=firstName;\n";
    print "insert into PCMember (contactId) values ($i) on duplicate key update contactId=contactId;\n";
}

while (<DATA>) {
    last if /^RATINGS/;
    my($p, $t, $n) = split;
    print "insert into Paper (paperId, title, authorInformation, abstract, timeSubmitted) values ($p, 'Paper $p', 'Jane\\tAuthor$p\\tauthor$p\@_.com\\t\\n', 'This is Paper $p', $now) on duplicate key update abstract=abstract;\n";
    print "insert into ContactInfo (firstName, lastName, email, password) values ('Jane', 'Author$p', 'author$p\@_.com', 'x') on duplicate key update password=password;\n";
    print "insert into PaperConflict (paperId, contactId, conflictType) values ($p, (select contactId from ContactInfo where email='author$p\@_.com'), 10) on duplicate key update conflictType=conflictType;\n";
    print "insert into PaperTag (paperId, tag, tagIndex) values ($p, '$t', $n) on duplicate key update tagIndex=$n;\n";
}

@ns = ();
while (<DATA>) {
    my($p, $c, $r) = split;
    $ns[$p] = 0 if !$ns[$p];
    my($ro) = ++$ns[$p];
    print "insert into PaperReview (paperId, contactId, reviewType, reviewModified, reviewSubmitted, reviewOrdinal, reviewNeedsSubmit, overAllMerit) values ($p, $c, 2, $now, $now, $ro, 0, $r) on duplicate key update reviewType=reviewType;\n";
}

__DATA__
1	10~r	13
1	11~r	5
1	12~r	32
1	14~r	10
1	6~r	22
2	14~r	7
2	27~r	47
2	29~r	28
2	6~r	29
2	7~r	4
3	17~r	9
3	27~r	34
3	28~r	23
3	29~r	27
3	2~r	3
3	4~r	6
3	6~r	8
4	12~r	17
4	15~r	7
4	18~r	9
4	28~r	32
4	2~r	32
5	10~r	20
5	15~r	13
5	23~r	4
5	29~r	26
6	10~r	6
6	17~r	13
6	18~r	7
6	21~r	5
6	26~r	11
6	2~r	13
6	30~r	9
7	15~r	4
7	17~r	28
7	19~r	8
7	24~r	19
7	25~r	9
7	28~r	11
7	6~r	17
8	10~r	13
8	18~r	6
8	24~r	10
8	26~r	3
8	29~r	6
8	6~r	11
8	8~r	4
9	10~r	23
9	11~r	7
9	13~r	4
9	14~r	9
9	17~r	14
10	13~r	5
10	14~r	10
10	17~r	8
10	19~r	16
10	24~r	24
10	25~r	15
10	5~r	5
11	10~r	24
11	11~r	14
11	17~r	26
11	19~r	28
12	21~r	10
12	2~r	34
12	9~r	5
13	10~r	21
13	14~r	8
13	15~r	11
13	22~r	11
13	2~r	31
14	12~r	36
14	23~r	7
14	9~r	3
15	10~r	25
15	7~r	10
16	14~r	10
16	4~r	13
17	16~r	12
17	23~r	14
18	11~r	6
18	14~r	8
18	17~r	18
18	21~r	3
18	24~r	14
18	27~r	37
18	28~r	7
18	29~r	17
18	2~r	16
19	19~r	36
19	21~r	12
19	30~r	15
20	10~r	3
20	11~r	17
20	12~r	23
20	22~r	9
20	23~r	3
20	24~r	7
20	27~r	21
20	29~r	6
20	6~r	20
21	19~r	7
21	24~r	11
21	27~r	21
21	28~r	30
21	29~r	19
21	2~r	2
21	3~r	6
21	4~r	10
21	6~r	21
22	14~r	9
22	17~r	29
22	27~r	37
23	20~r	10
23	28~r	35
23	5~r	21
24	11~r	3
24	12~r	3
24	14~r	1
24	17~r	1
24	22~r	0
24	24~r	3
24	27~r	1
24	29~r	2
24	6~r	2
25	11~r	19
25	14~r	10
25	15~r	9
25	17~r	17
25	6~r	28
25	9~r	5
26	11~r	22
26	23~r	12
26	24~r	31
26	29~r	22
27	10~r	13
27	26~r	12
27	2~r	26
28	11~r	10
28	19~r	2
28	22~r	2
28	24~r	16
28	27~r	3
28	28~r	12
28	2~r	14
28	6~r	9
29	10~r	21
29	24~r	25
29	29~r	25
29	8~r	11
30	17~r	3
30	19~r	1
30	20~r	1
30	24~r	1
30	25~r	1
30	27~r	13
30	28~r	8
30	6~r	4
31	11~r	33
31	12~r	26
31	17~r	20
31	28~r	36
32	12~r	6
32	15~r	1
32	17~r	30
32	20~r	6
32	27~r	3
32	2~r	11
32	6~r	15
33	16~r	14
33	7~r	11
34	23~r	15
34	24~r	15
34	27~r	24
34	30~r	7
34	8~r	6
35	13~r	15
35	26~r	18
35	4~r	17
36	10~r	12
36	17~r	7
36	24~r	4
36	26~r	1
36	27~r	30
36	28~r	3
36	6~r	6
37	12~r	27
37	14~r	9
37	23~r	5
37	27~r	24
38	10~r	8
38	12~r	21
38	15~r	5
38	17~r	11
38	22~r	12
38	24~r	13
38	28~r	16
38	5~r	11
38	6~r	12
39	18~r	14
39	30~r	12
39	9~r	5
40	10~r	5
40	11~r	2
40	14~r	2
40	16~r	2
40	17~r	2
40	23~r	6
40	27~r	11
40	29~r	3
40	6~r	13
41	12~r	46
41	25~r	23
42	14~r	7
42	20~r	2
42	28~r	18
42	4~r	8
42	6~r	24
43	2~r	28
43	7~r	9
43	8~r	8
44	10~r	11
44	14~r	7
44	18~r	5
44	19~r	3
44	23~r	1
44	27~r	7
44	28~r	15
45	11~r	28
45	12~r	24
45	15~r	2
45	17~r	12
45	29~r	20
45	2~r	22
45	9~r	3
46	10~r	19
46	28~r	27
46	29~r	27
46	2~r	29
46	7~r	6
47	22~r	15
47	24~r	36
47	30~r	14
48	14~r	9
48	25~r	17
48	26~r	10
48	2~r	30
48	4~r	12
49	19~r	27
49	22~r	15
49	27~r	49
50	27~r	37
50	2~r	33
51	17~r	32
51	25~r	18
52	17~r	15
52	24~r	12
52	30~r	8
53	11~r	15
53	27~r	15
53	28~r	21
53	7~r	8
54	17~r	23
54	20~r	5
54	22~r	6
54	27~r	26
54	5~r	6
55	10~r	21
55	11~r	24
55	12~r	10
55	19~r	6
55	22~r	10
55	23~r	2
55	24~r	21
55	29~r	13
56	20~r	8
56	23~r	13
56	24~r	28
56	28~r	24
57	16~r	3
57	17~r	16
57	24~r	8
57	27~r	5
57	28~r	2
57	5~r	1
57	6~r	5
57	7~r	1
58	11~r	43
58	21~r	11
58	3~r	13
59	14~r	8
59	18~r	11
59	20~r	16
60	22~r	15
60	3~r	9
60	7~r	14
61	12~r	9
61	17~r	6
61	24~r	5
61	27~r	19
61	28~r	1
61	2~r	5
62	14~r	10
62	25~r	20
62	5~r	30
63	14~r	5
63	17~r	24
63	24~r	33
63	27~r	32
63	29~r	27
64	16~r	11
64	20~r	15
64	5~r	1
65	14~r	6
65	27~r	39
65	5~r	20
65	9~r	1
66	17~r	33
66	20~r	11
66	25~r	13
66	29~r	12
66	2~r	15
66	4~r	4
67	17~r	25
67	22~r	8
67	27~r	24
67	5~r	9
68	10~r	4
68	12~r	19
68	14~r	6
68	21~r	2
68	24~r	27
68	29~r	11
68	2~r	23
68	6~r	27
69	16~r	16
69	23~r	18
70	11~r	30
70	14~r	8
70	15~r	6
70	20~r	13
70	26~r	6
70	27~r	11
70	9~r	3
71	12~r	37
71	16~r	10
72	11~r	20
72	16~r	4
72	19~r	10
72	21~r	1
72	29~r	27
72	4~r	5
73	12~r	44
73	13~r	14
73	16~r	15
74	12~r	43
74	23~r	11
74	8~r	9
75	10~r	13
75	16~r	9
75	24~r	23
75	29~r	18
75	3~r	5
76	13~r	7
76	17~r	22
76	18~r	8
76	22~r	4
76	2~r	24
77	11~r	25
77	12~r	35
77	13~r	11
77	17~r	19
77	22~r	3
77	25~r	7
77	27~r	34
77	7~r	7
78	10~r	10
78	11~r	34
78	12~r	9
78	29~r	8
78	4~r	9
79	16~r	6
79	23~r	8
79	27~r	34
79	7~r	13
80	23~r	17
80	6~r	30
81	6~r	31
82	13~r	12
82	24~r	35
82	25~r	11
83	12~r	38
83	24~r	26
83	25~r	4
83	28~r	33
83	5~r	10
84	10~r	2
84	11~r	1
84	12~r	1
84	18~r	1
84	19~r	1
84	27~r	3
84	2~r	7
84	6~r	1
84	8~r	2
85	17~r	31
85	19~r	11
85	20~r	10
85	28~r	10
85	29~r	15
85	2~r	12
85	5~r	8
86	27~r	41
86	3~r	8
87	16~r	13
87	25~r	21
87	4~r	15
88	10~r	21
88	11~r	21
88	14~r	6
88	19~r	4
88	22~r	5
88	28~r	17
88	2~r	10
88	6~r	23
88	8~r	5
89	11~r	27
89	13~r	8
89	27~r	45
89	29~r	29
90	12~r	20
90	17~r	10
90	23~r	10
90	28~r	9
90	30~r	6
90	9~r	3
91	10~r	13
91	13~r	2
91	14~r	6
91	17~r	4
91	20~r	3
91	29~r	6
91	6~r	10
92	27~r	37
92	28~r	28
92	5~r	12
93	20~r	14
93	22~r	7
93	28~r	29
94	10~r	18
94	16~r	8
94	24~r	32
94	25~r	3
94	27~r	34
94	3~r	12
94	4~r	7
95	21~r	9
95	26~r	15
96	6~r	32
97	12~r	30
97	14~r	8
97	23~r	9
97	24~r	17
97	28~r	20
98	11~r	39
98	19~r	24
99	10~r	17
99	17~r	34
99	19~r	19
99	26~r	8
99	28~r	26
100	11~r	35
100	12~r	39
100	13~r	13
100	19~r	15
100	26~r	4
100	30~r	10
101	21~r	7
101	24~r	30
101	6~r	25
102	17~r	35
102	24~r	34
102	4~r	16
103	19~r	15
103	20~r	9
103	24~r	22
103	3~r	4
104	14~r	9
104	18~r	12
104	20~r	4
104	22~r	13
104	29~r	21
105	18~r	10
105	19~r	22
105	26~r	14
105	30~r	3
106	19~r	20
106	29~r	27
106	2~r	27
106	3~r	10
106	4~r	11
107	11~r	23
107	13~r	1
107	14~r	8
107	16~r	5
107	28~r	31
107	29~r	7
107	7~r	3
108	23~r	19
108	8~r	12
109	10~r	21
109	11~r	37
109	12~r	33
109	16~r	7
109	19~r	21
110	10~r	13
110	14~r	8
110	15~r	8
110	28~r	14
111	18~r	3
111	19~r	14
111	21~r	8
111	30~r	5
112	11~r	31
112	19~r	5
112	25~r	8
112	29~r	10
112	2~r	4
112	30~r	4
112	4~r	1
112	6~r	7
113	13~r	6
113	14~r	9
113	24~r	29
113	28~r	25
113	4~r	14
114	11~r	38
114	12~r	44
114	18~r	4
114	6~r	26
115	17~r	37
115	23~r	16
116	10~r	14
116	11~r	2
116	12~r	13
116	14~r	8
116	29~r	6
116	2~r	18
116	3~r	7
116	7~r	5
116	8~r	8
117	11~r	8
117	14~r	3
117	15~r	3
117	19~r	1
117	28~r	6
117	29~r	4
117	2~r	9
117	3~r	3
118	10~r	9
118	11~r	12
118	13~r	9
118	14~r	5
118	19~r	13
118	24~r	9
118	29~r	14
118	6~r	16
118	8~r	10
119	12~r	7
119	13~r	10
119	14~r	7
119	17~r	27
119	19~r	9
119	27~r	13
119	3~r	2
119	6~r	18
120	11~r	9
120	14~r	4
120	16~r	1
120	17~r	5
120	24~r	6
120	2~r	8
120	3~r	5
120	6~r	3
121	6~r	34
122	10~r	22
122	14~r	7
122	22~r	1
122	24~r	20
122	28~r	22
122	2~r	17
122	9~r	5
123	12~r	42
123	26~r	16
123	28~r	19
123	30~r	2
123	9~r	3
124	10~r	13
124	11~r	16
124	12~r	15
124	20~r	7
124	27~r	11
124	28~r	5
124	2~r	19
124	5~r	7
125	10~r	7
125	13~r	3
125	17~r	21
125	25~r	14
125	27~r	9
125	29~r	5
125	3~r	1
125	4~r	3
125	6~r	14
126	19~r	17
126	21~r	7
126	2~r	25
126	3~r	11
127	14~r	8
128	10~r	1
128	12~r	4
128	24~r	2
128	28~r	4
128	29~r	1
128	2~r	1
128	4~r	2
128	8~r	1
129	26~r	17
129	30~r	11
129	9~r	5
130	18~r	13
130	28~r	34
130	5~r	25
131	10~r	16
131	11~r	29
131	12~r	14
131	14~r	3
131	24~r	18
131	27~r	17
131	29~r	16
131	2~r	6
132	15~r	12
132	26~r	5
132	30~r	13
133	10~r	15
133	12~r	44
133	29~r	29
133	3~r	9
134	6~r	33
135	19~r	18
135	29~r	29
135	7~r	12
136	11~r	13
136	12~r	22
136	19~r	12
136	2~r	20
137	10~r	26
137	23~r	20
138	10~r	21
138	12~r	31
138	18~r	2
138	19~r	9
138	21~r	6
138	26~r	7
138	27~r	28
138	2~r	21
138	30~r	1
138	6~r	19
139	17~r	36
139	19~r	23
139	25~r	6
139	27~r	43
139	28~r	13
140	11~r	41
140	15~r	10
140	18~r	15
128	lr	1
84	lr	2
24	lr	3
30	lr	4
40	lr	5
61	lr	6
120	lr	7
36	lr	8
57	lr	9
117	lr	10
112	lr	11
91	lr	12
28	lr	13
6	lr	14
90	lr	15
125	lr	16
44	lr	17
8	lr	18
38	lr	19
32	lr	20
118	lr	21
52	lr	22
78	lr	23
124	lr	24
119	lr	25
20	lr	26
3	lr	27
131	lr	28
7	lr	29
116	lr	30
21	lr	31
18	lr	32
88	lr	33
85	lr	34
53	lr	35
68	lr	36
42	lr	37
34	lr	38
110	lr	39
136	lr	40
1	lr	41
27	lr	42
122	lr	43
75	lr	44
107	lr	45
55	lr	46
97	lr	47
72	lr	48
45	lr	49
54	lr	50
70	lr	51
138	lr	52
5	lr	53
37	lr	54
111	lr	55
103	lr	56
29	lr	57
10	lr	58
9	lr	59
76	lr	60
14	lr	61
66	lr	62
65	lr	63
123	lr	64
56	lr	65
67	lr	66
77	lr	67
63	lr	68
101	lr	69
79	lr	70
26	lr	71
59	lr	72
94	lr	73
126	lr	74
113	lr	75
106	lr	76
92	lr	77
46	lr	78
43	lr	79
104	lr	80
99	lr	81
25	lr	82
93	lr	83
2	lr	84
4	lr	85
86	lr	86
13	lr	87
22	lr	88
50	lr	89
135	lr	90
31	lr	91
139	lr	92
89	lr	93
109	lr	94
71	lr	95
83	lr	96
100	lr	97
11	lr	98
82	lr	99
74	lr	100
23	lr	101
48	lr	102
105	lr	103
114	lr	104
133	lr	105
64	lr	106
16	lr	107
17	lr	108
132	lr	109
51	lr	110
130	lr	111
15	lr	112
98	lr	113
95	lr	114
12	lr	115
87	lr	116
80	lr	117
39	lr	118
62	lr	119
102	lr	120
81	lr	121
49	lr	122
33	lr	123
115	lr	124
73	lr	125
96	lr	126
129	lr	127
140	lr	128
69	lr	129
47	lr	130
134	lr	131
60	lr	132
41	lr	133
108	lr	134
35	lr	135
121	lr	136
58	lr	137
137	lr	138
19	lr	139
RATINGS
1	10	3
1	11	4
1	12	3
1	14	2
1	6	2
10	13	4
10	14	2
10	17	3
10	19	2
10	24	2
10	25	2
10	5	4
10	6	0
100	11	3
100	12	3
100	13	3
100	19	3
100	26	4
100	30	2
101	21	3
101	24	2
101	6	2
102	17	2
102	24	2
102	4	2
103	11	3
103	19	3
103	20	3
103	24	3
103	27	3
103	3	4
103	6	0
104	14	3
104	18	2
104	20	4
104	22	3
104	29	3
105	18	3
105	19	2
105	26	2
105	30	3
106	19	3
106	2	2
106	29	2
106	3	3
106	4	3
107	11	3
107	13	4
107	14	4
107	16	4
107	19	0
107	28	2
107	29	4
107	6	0
107	7	4
108	23	3
109	10	2
109	11	2
109	12	3
109	16	3
109	19	2
11	10	3
11	11	3
11	17	3
11	19	2
110	10	3
110	14	3
110	15	3
110	19	3
110	28	3
110	6	0
111	18	4
111	19	3
111	21	3
111	30	3
112	11	3
112	19	3
112	2	5
112	25	3
112	27	4
112	29	2
112	30	3
112	4	5
112	6	4
113	13	3
113	14	3
113	24	2
113	28	2
113	4	2
114	11	2
114	12	2
114	18	4
114	6	2
115	17	2
115	23	2
116	10	4
116	11	4
116	12	3
116	14	3
116	2	3
116	29	4
116	3	3
116	7	4
116	8	2
117	11	4
117	14	4
117	15	4
117	19	4
117	2	4
117	28	4
117	29	4
117	3	4
118	10	4
118	11	3
118	13	3
118	14	4
118	19	3
118	24	3
118	29	3
118	6	3
118	8	2
119	12	4
119	13	3
119	14	3
119	17	2
119	19	3
119	27	3
119	3	5
119	6	3
12	2	2
12	21	2
12	9	2
120	11	4
120	14	4
120	16	5
120	17	4
120	2	4
120	24	4
120	3	4
120	6	5
121	6	1
122	10	2
122	14	3
122	2	3
122	22	5
122	24	3
122	28	3
122	8	3
122	9	2
123	12	2
123	26	2
123	28	3
123	30	3
123	9	3
124	10	2
124	11	3
124	12	3
124	2	3
124	20	3
124	21	0
124	27	4
124	28	4
124	5	3
125	10	3
125	13	4
125	17	3
125	25	2
125	27	4
125	29	4
125	3	5
125	4	4
125	6	3
126	19	3
126	2	2
126	21	3
126	3	2
127	14	3
128	10	5
128	12	4
128	15	4
128	2	5
128	24	5
128	28	4
128	29	5
128	4	4
128	8	5
129	26	2
129	30	2
129	9	2
13	10	3
13	14	3
13	15	3
13	2	2
13	22	3
130	18	2
130	28	2
130	5	1
131	10	3
131	11	3
131	12	3
131	14	4
131	15	4
131	2	4
131	24	3
131	27	3
131	29	3
132	15	2
132	26	3
132	30	2
133	10	2
133	12	3
133	23	3
133	29	2
133	3	3
134	6	1
135	19	3
135	29	2
135	7	2
136	11	3
136	12	3
136	19	3
136	2	3
137	10	1
137	23	1
138	10	2
138	12	3
138	18	4
138	19	3
138	2	3
138	21	3
138	26	3
138	27	3
138	30	4
138	6	3
139	17	2
139	19	2
139	25	4
139	27	2
139	28	3
14	12	2
14	23	3
14	9	2
140	11	2
140	15	3
140	18	1
15	10	2
15	7	2
16	14	2
16	4	2
17	16	2
17	23	2
18	11	4
18	14	3
18	17	3
18	2	3
18	21	3
18	24	3
18	27	2
18	28	4
18	29	3
19	19	1
19	21	1
19	30	1
2	14	3
2	27	2
2	29	2
2	6	2
2	7	4
20	10	5
20	11	4
20	12	3
20	22	4
20	23	5
20	24	3
20	27	3
20	29	4
20	6	3
20	9	0
21	19	3
21	2	5
21	24	3
21	27	3
21	28	2
21	29	3
21	3	4
21	4	3
21	6	3
22	14	3
22	17	2
22	27	3
23	20	2
23	28	2
23	5	2
24	11	4
24	12	4
24	14	5
24	17	5
24	22	5
24	24	4
24	27	5
24	29	4
24	6	5
25	11	2
25	14	2
25	15	3
25	17	3
25	6	2
25	9	1
26	11	3
26	23	3
26	24	2
26	29	3
27	10	3
27	2	2
27	26	2
28	11	3
28	19	5
28	2	4
28	22	4
28	24	3
28	27	4
28	28	4
28	6	4
29	10	3
29	13	0
29	24	2
29	29	3
3	17	4
3	2	5
3	27	2
3	28	3
3	29	2
3	4	3
3	6	4
3	7	3
30	17	5
30	19	4
30	20	4
30	24	5
30	25	5
30	27	3
30	28	4
30	6	4
31	11	3
31	12	3
31	17	3
31	28	2
32	12	4
32	15	5
32	17	2
32	2	4
32	20	3
32	27	4
32	6	3
32	7	3
33	16	2
33	7	2
34	23	3
34	24	3
34	27	3
34	30	3
35	13	1
35	26	1
35	4	2
36	10	3
36	17	4
36	24	4
36	26	4
36	27	3
36	28	4
36	6	4
36	8	3
37	12	3
37	14	3
37	23	3
37	27	3
38	10	4
38	12	3
38	15	4
38	17	4
38	22	3
38	24	3
38	28	3
38	5	3
38	6	4
39	18	2
39	30	2
39	9	2
4	12	3
4	15	3
4	18	3
4	2	2
4	23	3
4	28	3
4	9	0
40	10	4
40	11	5
40	14	5
40	16	3
40	17	5
40	23	4
40	27	4
40	29	4
40	6	4
41	12	1
41	25	2
42	14	3
42	17	3
42	20	4
42	23	3
42	28	3
42	4	3
42	6	2
43	2	2
43	7	2
43	8	2
44	10	4
44	14	4
44	18	3
44	19	4
44	23	5
44	27	4
44	28	4
44	6	0
45	11	3
45	12	3
45	15	5
45	17	4
45	2	3
45	25	3
45	29	3
45	6	0
45	9	2
46	10	3
46	2	2
46	28	2
46	29	3
46	7	4
47	22	2
47	24	2
47	30	2
48	14	3
48	2	2
48	25	2
48	26	3
48	4	3
49	19	2
49	22	2
49	27	2
5	10	2
5	15	3
5	23	4
5	29	2
50	2	2
50	27	3
51	17	2
51	25	2
52	17	3
52	24	3
52	30	3
53	11	3
53	27	4
53	28	3
53	7	3
54	17	3
54	20	3
54	22	4
54	27	3
54	5	3
55	10	3
55	11	3
55	12	4
55	19	3
55	22	3
55	23	4
55	24	3
55	29	3
55	6	0
56	20	3
56	23	2
56	24	2
56	28	2
57	16	3
57	17	3
57	24	3
57	27	4
57	28	5
57	5	4
57	6	4
57	7	5
58	11	2
58	21	2
58	3	1
59	14	3
59	18	2
59	20	2
6	10	4
6	17	3
6	18	3
6	2	4
6	21	4
6	26	3
6	30	3
6	6	4
60	22	2
60	3	3
60	7	2
61	12	4
61	17	4
61	2	5
61	24	4
61	27	3
61	28	5
61	8	3
62	14	2
62	25	2
62	5	2
63	13	0
63	14	4
63	17	3
63	24	2
63	27	2
63	29	3
63	6	0
64	16	2
64	20	2
65	14	3
65	27	2
65	5	2
65	9	3
66	17	2
66	19	0
66	2	3
66	20	3
66	25	3
66	29	3
66	4	4
66	6	0
67	17	3
67	19	0
67	22	3
67	27	4
67	5	3
67	6	0
68	10	4
68	12	3
68	14	4
68	2	2
68	21	4
68	24	2
68	29	3
68	6	2
69	16	1
69	23	2
7	15	4
7	17	2
7	19	3
7	24	3
7	25	3
7	28	4
7	6	3
7	8	3
70	11	3
70	14	3
70	15	3
70	20	2
70	26	3
70	27	4
70	6	0
70	9	3
71	12	2
71	16	2
72	11	3
72	16	4
72	19	3
72	21	4
72	29	3
72	4	3
72	6	0
72	8	3
73	12	2
73	13	2
73	16	1
74	12	2
74	23	2
74	8	2
75	10	3
75	16	3
75	23	3
75	24	3
75	29	3
75	3	4
75	6	0
76	11	3
76	13	3
76	17	4
76	18	3
76	2	2
76	22	3
77	11	3
77	12	3
77	13	3
77	17	3
77	22	4
77	25	4
77	27	2
77	6	0
77	7	3
78	10	4
78	11	3
78	12	4
78	19	0
78	29	4
78	4	3
78	6	0
79	16	3
79	23	4
79	27	2
79	7	2
8	10	3
8	18	3
8	24	3
8	26	4
8	29	4
8	6	4
8	8	4
8	9	0
80	23	2
80	6	1
81	6	1
82	13	2
82	24	2
82	25	3
83	12	2
83	24	2
83	25	4
83	28	2
83	5	3
84	10	5
84	11	4
84	12	5
84	18	5
84	19	5
84	2	4
84	27	4
84	6	5
85	17	2
85	19	3
85	2	4
85	20	2
85	28	4
85	29	3
85	5	3
85	6	0
86	27	2
86	3	3
87	16	2
87	25	2
87	4	2
88	10	3
88	11	3
88	14	3
88	19	3
88	2	4
88	22	3
88	28	3
88	6	2
89	11	3
89	13	4
89	27	2
89	29	2
9	10	2
9	11	3
9	13	4
9	14	3
9	17	3
90	12	3
90	17	4
90	23	3
90	28	4
90	30	3
90	9	2
91	10	4
91	13	4
91	14	3
91	17	5
91	20	4
91	29	4
91	6	4
92	27	3
92	28	2
92	5	2
93	20	2
93	22	3
93	28	2
94	10	2
94	16	2
94	23	4
94	24	2
94	25	4
94	27	2
94	3	2
94	4	3
94	6	0
95	21	2
95	26	2
96	6	1
97	12	3
97	14	3
97	23	3
97	24	3
97	28	3
98	11	3
98	19	2
99	10	3
99	17	2
99	19	3
99	26	3
99	28	2
