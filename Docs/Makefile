#################################################
#												#
#	         Makefile pour LaTeX                #
#			                                    #
#           use : make file=cv.tex              #
#################################################

TEX_CMD := pdflatex
TEX_FLAGS := #-c
TEX := $(file)
TEX_PDF := $(TEX:.tex=.pdf)

UNAME := $(shell uname)
ifeq ($(UNAME), Darwin)
	TEX_CALL := open -g $(TEX_PDF)
endif
ifeq ($(UNAME), Linux)
	TEX_CALL := evince $(TEX_PDF) &
endif


TEX_IMG_DIR := img
TEX_IMG=$(wildcard $(TEX_IMG_DIR)/*.svg)

TEX_I_PDF:=$(TEX_IMG:.pgm=.pdf)
TEX_I_PDF:=$(TEX_I_PDF:.svg=.pdf)

tex: $(TEX_PDF)
	$(TEX_CALL)

$(TEX_PDF): $(TEX) $(TEX_I_PDF)
	$(TEX_CMD) $(TEX_FLAGS) '$<'
# $(TEX_CMD) $(TEX_FLAGS) '$<' #A priori pour table des matieres
# $(TEX_CMD) $(TEX_FLAGS) '$<' #A priori pour biblio
	rm -rf $(TEX:.tex=.aux) $(TEX:.tex=.log) $(TEX:.tex=.out)

%.pdf : *.svg
	convert '$<' '$@'

texclean:
	@echo "Deleting compilation files"

	@rm -rf *.log *.aux *.toc *.out
