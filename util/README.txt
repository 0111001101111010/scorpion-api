C3-SCORPION RELEASE NOTES
=========================

C3-SCORPION : Protein Secondary Structure Prediction using Context-based Features
Version 1.0
Copyright (C) 2014 Ashraf Yaseen and Yaohang Li - Created : January  01/20/2014


Here are some very brief notes on using C3-SCORPION V1

C3-SCORPION is supplied in source code form. 

Please see the LICENSE file for the license terms for the software.
Basically it's free to anyone (including commercial users) as long as
you don't want to sell the software or, for example, store the results
obtained with it in a database and then try to sell the database.

Before running C3-SCORPION, please check the script to see if the path variables 
are set to wherever you have installed the program and data files. 
The default is to assume that the program is installed in the current directory.

INSTALLATION
============

The executables will be placed in the src directory.

You must also install the PSI-BLAST and Impala software from the
NCBI toolkit, and also install appropriate sequence data banks (NR).
The NCBI toolkit can be obtained from URL ftp://ftp.ncbi.nih.gov
PSI-BLAST executables can be obtained from ftp://ftp.ncbi.nih.gov/blast
NR database can be obtained from ftp://ftp.ncbi.nlm.nih.gov/blast/db/

USAGE
=====
usage: c3scorpion <blastpgp> <nrdir> <sequencefile>
<blastpgp>      -- complete path of blastpgp
<nrdir>         -- complete directory of nr database
<sequence file> -- sequence file to predict secondary structure

EXAMPLE USAGE
=============

In this example the target sequence is called "2fft.fasta":

% c3scorpion /home/yaohang/sspred/blast_2_2_24/bin/blastpgp /home/yaohang/sspred/NR 2fft.fasta
*************************************************************************************
* C3-Scorpion : Protein Secondary Structure Prediction using Context-based Features *
* Version 1.0                                                                       *
*                                                                                   *
* Please cite                                                                       *
* A. Yaseen, Y. Li, Context-based Features Enhance Protein Secondary Structure      *
* Prediction Accuracy, Journal of Chemical Information and Modeling, under          *
* revision, 2014.                                                                   *
*************************************************************************************

Encoding Level 1 ...
Predicting Level 1 ...
Encoding Level 2 ...
Predicting Level 2 ...
Encoding Level 3 ...
Predicting Level 3 ...

SCORPION Prediction:
SAAKGTAETKQEKSFVDWLLGKITKEDQFYETDPILRGGDVKSSGSTSGKKGGTTSGKKGTVSIPSKKKNGNGGVFGGLF
CCCCCCCCCCCCCCHHHHHHCCCCCCCCEECCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCECCCCCCCCCCCCCCCCCC
99887767655679589987467564644457976567765668887788888777777756478876789888667679


SEQUENCE DATA BANK
==================

It is important to ensure than the sequence data bank used with PSI-BLAST
has been filtered to remove low-complexity regions, transmembrane regions,
and coiled-coil segments. 


